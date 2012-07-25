<?php

/**
 * Grupo actions.
 *
 * @package    CALPESPOL
 * @subpackage Grupo
 * @author     ABEJJA
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoActions extends sfActions {

    public function executeMateria(sfWebRequest $request) {
        $cursos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->where('a.anio = ?',$request->getParameter('anio'))
                ->andWhere('a.termino = ?',$request->getParameter('termino'))
                ->execute();
        $this->materias = array();
        foreach ($cursos as $curso) {
                $bandera = true;
                foreach ($this->materias as $materia)
                    if(strcmp($materia->getNombre(),$curso->getMateria()->getNombre())==0)
                            $bandera = false;
                if($bandera)
                    array_push($this->materias,$curso->getMateria());
        }
    }

    public function executeParalelo(sfWebRequest $request) {
        $this->paralelos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->leftJoin('a.Materia m')
                ->where('a.anio = ?',$request->getParameter('anio'))
                ->andWhere('a.termino = ?',$request->getParameter('termino'))
                ->andWhere('m.nombre = ?',$request->getParameter('materia'))
                ->execute();
    }

    public function executeConsulta(sfWebRequest $request) {
        $this->estudiantes = Doctrine_Core::getTable('Estudiantecurso')
                ->createQuery('e')
                ->leftJoin('e.Usuario u')
                ->leftJoin('e.Grupo g')
                ->where('e.id_curso = ?',$cursos[0]->getId())
                ->orderBy('g.numero, u.nombre')
                ->execute();
    }
    
    public function executeGrupos(sfWebRequest $request) {
        $cursos = Doctrine_Core::getTable('Curso')
                ->createQuery('a')
                ->leftJoin('a.Materia m')
                ->where('a.anio = ?',$request->getParameter('anio'))
                ->andWhere('a.termino = ?',$request->getParameter('termino'))
                ->andWhere('a.paralelo = ?',$request->getParameter('paralelo'))
                ->andWhere('m.nombre = ?',$request->getParameter('materia'))
                ->execute();
        $estudiantes_cursos = Doctrine_Core::getTable('Estudiantecurso')
                ->createQuery('a')
                ->where('a.id_curso = ?',$cursos[0]->getId())
                ->execute();
        $this->estudiantes = array();
        foreach ($estudiantes_cursos as $estudiante)
            if($estudiante->getGrupo()->getNumero()==null)
                array_push($this->estudiantes,$estudiante);
    }

    public function executeIndex(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()){
            $materias = Doctrine_Core::getTable('Materia')
                    ->createQuery('m')
                    ->where('m.nombre = ?',$this->getUser()->getMateriaActual())
                    ->execute();
            $id_materia = $materias[0].getCodigoMateria();
            $roles = Doctrine_Core::getTable('Rolusuario')
                    ->createQuery('r')
                    ->where('r.nombre = ?','Estudiante')
                    ->execute();
            $id_rol = $roles[0].getIdrolusuario();
            $cursos = Doctrine_Core::getTable('Curso')
                    ->createQuery('c')
                    ->where('c.paralelo = ?',$this->getUser()->getParaleloActual())
                    ->andWhere('c.id_materia = ?', $id_materia)
                    ->execute();
            $id_curso = $cursos[0].getIdcurso();
            $this->lista = DoctrineCore::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
        }
    }

    public function executeNew(sfWebRequest $request) {
        $this->mensaje="";
        $id_curso=$request->getParameter('curso');
        $usuarios = array();
        for ($index = 1; $index <= $request->getParameter('num'); $index++){
            array_push($usuarios,$request->getParameter('param'.$index));
        }
        $estudiantes = Doctrine::getTable('Estudiantecurso')
                ->createQuery('e')
                ->where('e.id_curso = ?',$id_curso)
                ->andWhereIn('e.id_usuario', $usuarios)
                ->execute();
        $bandera = 1;
        foreach ($estudiantes as $estudiante)
            if($estudiante->getGrupo()->getNumero()!=null)
                $bandera=0;
        if($bandera==1){
            $max = 0;
            $grupos = Doctrine_Core::getTable('Grupo')
                    ->createQuery('a')
                    ->where('a.id_curso = ?',$id_curso)
                    ->execute();
            foreach ($grupos as $value)
                if($value->getNumero()>$max)
                    $max = $value->getNumero();
            try{
                $grupo = new Grupo();
                $grupo->setIdCurso($id_curso);
                $grupo->setNumero($max+1);
                $grupo->save();
            }catch(Exception $e){
                $this->mensaje = "No se pudo crear el grupo";
            }
            try{
            $grupos = Doctrine_Core::getTable('Grupo')
                    ->createQuery('a')
                    ->where('a.id_curso = ?',$id_curso)
                    ->andWhere('a.numero = ?',$max+1)
                    ->execute();
            $grupo=$grupos[0];
            foreach ($estudiantes as $estudiante){
                $estudiante->setGrupo($grupo);
                $estudiante->save();
            }
            }catch(Exception $e){
                $this->mensaje = "No se pudo actualizar el grupo en los estudiantes";
            }
            $this->mensaje = "Los estudiantes fueron asignados al grupo: ".($max+1);
        }elseif ($bandera==0) {
            $this->mensaje = "Uno de los estudiantes seleccionados ya fue asignado a otro grupo";
        }
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new GrupoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($grupo = Doctrine_Core::getTable('Grupo')->find(array($request->getParameter('id'))), sprintf('Object grupo does not exist (%s).', $request->getParameter('id')));
        $this->form = new GrupoForm($grupo);
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

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $grupo = $form->save();

            $this->redirect('Grupo/edit?id=' . $grupo->getId());
        }
    }

}
