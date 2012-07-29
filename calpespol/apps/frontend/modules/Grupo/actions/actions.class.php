<?php

/**
 * Grupo actions.
 *
 * @package    CALPESPOL
 * @subpackage Grupo
 * @author     Brick Reyes Zambrano
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoActions extends sfActions {

    /**
     * 
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
            $this->lista = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->rol = $this->getActualRol()->getNombre();
        }else
            $this->redirect('Inicio/index');
            
    }

    public function executeNew(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
            $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->lista = array();
            foreach ($estudiantes as $objeto)
                if(Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)
                    array_push ($this->lista, $objeto);
            $this->rol = $this->getActualRol()->getNombre();
        }else{
            $this->redirect('Inicio/index');
        }
    }

    /**
     * Nos permite crear un nuevo grupo con los datos enviados por request
     */
    public function executeCreate(sfWebRequest $request) {
		// Obtengo los parametros
		$n_estudiantes = $request->getParameter("size");
		$lista = array();
		for($i=0;$i<$n_estudiantes;$i++)
			array_push($lista,$request->getParameter('param'.$i));
		$id_curso = $request->getParameter('curso');
		// Verifico que ninguno de los estudiantes seleccionados pertenezca ya a algún grupo
		$bandera = true;
		foreach($lista as $objeto)
			if(Estudiantegrupo::getGrupoDeEstudiante($objeto)!=null)
				$bandera = false;
		// Ejecuto las siguientes sentencias solo en caso de que ninguno tenga grupo
		if($bandera){
                    // Obtengo el número de grupos que existen en el curso
                    $q = Doctrine_Query::create()
                        ->select('max(eg.idgrupo) as id')
                        ->from('EstudianteGrupo eg')
                        ->innerJoin('eg.UsuarioCurso uc')
                        ->where('uc.id_curso = ?', $id_curso);
                    $tmp = $q->fetchArray();
                    $id_grupo = $tmp[0]['id'];
                    $grupo = Doctrine_Core::getTable('Grupo')
                        ->createQuery('g')
                        ->whereIn('g.idgrupo', $id_grupo)
                        ->execute();
                    $n_grupo = $grupo[0]->getNumero();
                    $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                        ->createQuery('uc')
                        ->whereIn('uc.id_usuario_curso', $lista)
                        ->execute();
                    if(sizeof($estudiantes)==sizeof($lista)){
                        try{
                            // Se crea un nuevo grupo
                            $grupo = new Grupo();
                            $grupo->setNumero($n_grupo+1);
                            $grupo->setNombre('Grupo '.($n_grupo+1));
                            $grupo->save();
                            try{
                                // A cada estudiante lo vinculo con dicho grupo que recién se creó.
                                foreach($estudiantes as $objeto){
                                    // Se crea una relación entre cada UsuarioCurso y el Grupo
                                    $eg = new EstudianteGrupo();
                                    $eg->setIdGrupo($grupo->getIdGrupo());
                                    $eg->setIdEstudiante($objeto->getIdUsuarioCurso());
                                    $eg->save();
                                }
                                $this->mensaje = "El Grupo ".($n_grupo+1)." ha sido creado.";
                            }catch(Exception $e2){
                                $this->mensaje = "Error al añadir a los estudiantes a los grupos";
                            }
                        }catch(Exception $e){
                            $this->mensaje = "Error al crear el grupo";
                        }
                    }else
                        $this->redirect('Grupo/index');
		}else
			$this->mensaje = "Uno de los estudiantes seleccionados ya pertenece a algún grupo";
        
    }

    public function executeEdit(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
            $this->lista = Doctrine_Core::getTable('Grupo')
                    ->createQuery('g')
                    ->innerJoin('g.Estudiantegrupo eg')
                    ->innerJoin('eg.UsuarioCurso uc')
                    ->where('uc.id_curso = ?',$id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
        }else{
            $this->redirect('Inicio/index');
        }
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $this->form = new GrupoForm($grupo);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $grupo->delete();

        $this->redirect('Grupo/index');
    }

    /**
     * Dado el nombre de un rol en forma de string devuelve
     * el id del mismo en caso que no exista retornará -1
     * @param string $nombre_rol Contiene el nombre del rol
     * @return integer contiene el id del rol
     */
    private function getIDRol($nombre_rol){
        try {
            $roles = Doctrine_Core::getTable('Rolusuario')
                    ->createQuery('r')
                    ->where('r.nombre = ?',$nombre_rol)
                    ->execute();
            return $roles[0]->getIdrolusuario();
        }  catch (Exception $e){
            return -1;
        }
    }
    
    /**
     * 
     * @return Rolusuario
     */
    private function getActualRol(){
        $id_curso = Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual())->getIdcurso();
        $id_usuario = $this->getUser()->getUserDB()->getIdusuario();
        $temp =  Doctrine_Core::getTable('UsuarioCurso')
                ->createQuery('uc')
                ->where('uc.id_curso = ?', $id_curso)
                ->andWhere('uc.id_usuario = ?', $id_usuario)
                ->execute();
        return $temp[0]->getRolusuario();
    }
}
