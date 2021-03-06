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
     * Descripción: Función que me permite conectarme a la base y obtener la lista de estudiantes
     * y grupos, que pertenecen al curso almacenado en sesión.
     * Escenarios Fallidos:
     *  - Si no se ha seleccionado la materia o el paralelo del cual se desea consultar
     *    se lo redirecciona a la página principal de la aplicación.
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
            $this->lista = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->rol = $this->getActualRol()->getNombre();
        }else
            $this->redirect('Inicio/index');
            
    }

    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista de estudiantes
     * que no pertenecen a ningún grupo.
     * Escenarios Fallidos:
     *  - Si no se ha seleccionado la materia o el paralelo del cual se desea consultar
     *    se lo redirecciona a la página principal de la aplicación.
     *  - Si no se encuetra autenticado se lo redirecciona al Login.
     * @param sfWebRequest $request
     */
    public function executeNew(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            $id_rol = $this->getIDRol("Estudiante");
            $this->id_curso = Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
            $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                    ->createQuery('uc')
                    ->where('uc.id_curso = ?',$this->id_curso)
                    ->andWhere('uc.id_rol = ?', $id_rol)
                    ->execute();
            $this->lista = array();
            foreach ($estudiantes as $objeto)
                if(Grupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)
                    array_push ($this->lista, $objeto);
        }else{
            $this->redirect('Inicio/index');
        }
    }

    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista de estudiantes
     * que no pertenecen a ningún grupo.
     * Escenarios Fallidos:
     *  - Si no se han enviado todos los parametros -> Se muestra un mensaje.
     *  - Si no se encuetra autenticado -> lo redirecciona al Login.
     *  - Si alguno de los estudiantes ya pertenece a algún grupo -> Muestra respectivo mensaje
     *  - Si el usuario que crea el grupo es de rol estudiante y no pertenece al grupo que está
     *  creando -> No se crea el grupo y se muestra respectivo mensaje.
     * @param sfWebRequest $request
     */
    public function executeCreate(sfWebRequest $request) {
        if($this->getUser()->getUserEspol()!=null){
            try{
		// Obtengo los parametros
		$n_estudiantes = $request->getParameter("size");
		$lista = array();
		for($i=0;$i<$n_estudiantes;$i++)
			array_push($lista,$request->getParameter('param'.$i));//estos son los id de los estudiantes?? simon dejame corregir algo
		$id_curso = $request->getParameter('curso');
		// Verifico que ninguno de los estudiantes seleccionados pertenezca ya a algún grupo
		$bandera = true;
		foreach($lista as $objeto)
			if(Grupo::getGrupoDeEstudiante($objeto)!=null)
				$bandera = false;
		// Ejecuto las siguientes sentencias solo en caso de que ninguno tenga grupo
		if($bandera){
                    // Obtengo el número de grupos que existen en el curso
                    $q = Doctrine_Query::create()
                        ->select('ifnull(max(eg.idgrupo),0) as id')
                        ->from('EstudianteGrupo eg')
                        ->innerJoin('eg.UsuarioCurso uc')
                        ->where('uc.id_curso = ?', $id_curso);
                    $tmp = $q->fetchArray();
                    $id_grupo = $tmp[0]['id'];
                    if($id_grupo!=null){
                        $grupo = Doctrine_Core::getTable('Grupo')
                            ->createQuery('g')
                            ->whereIn('g.idgrupo', $id_grupo)
                            ->execute();
                        $n_grupo = $grupo[0]->getNumero();
                    }else
                        $n_grupo = 0;
                    $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                        ->createQuery('uc')
                        ->whereIn('uc.id_usuario_curso', $lista)
                        ->execute();
                    $bandera2 = false;
                    foreach($estudiantes as $estudiante)
                        if($estudiante->getUsuario()->getUsuarioEspol()==$this->getUser()->getUserEspol())
                            $bandera2 = true;
                    if($bandera2||$this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
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
                        $this->mensaje = "Usted debe pertenecer al grupo";
		}else
			$this->mensaje = "Uno de los estudiantes seleccionados ya pertenece a algún grupo";
            }catch(Exception $e){
                $this->mensaje = "Faltan parámetros en la petición";
            }
        }else{
            $this->mensaje = "Usted no esta autenticado.";
        }
    }

    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista de estudiantes
     * que pertenecen al curso actual y que también pertenezcan a algún grupo.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado -> lo redirecciona al Login.
     *  - Si el usuario no tiene rol de Ayudante o Profesor para dicho curso ->  Se lo redirecciona
     *  a la consulta de grupos.
     * @param sfWebRequest $request
     */
    public function executeDelete(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            if($this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
                $this->lista = Doctrine_Core::getTable('Grupo')
                ->createQuery('g')
                ->innerJoin('g.Estudiantegrupo eg')
                ->innerJoin('eg.UsuarioCurso uc')
                ->where('uc.id_curso = ?', Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual()))
                ->andWhere('uc.id_rol = ?', $this->getIDRol("Estudiante"))
                ->execute();
            }else
                $this->redirect('Grupo/index');
        }else{
            $this->redirect('Inicio/index');
        }
    }
    
    /**
     * Descripción: Función que me permite conectarme a la base y eliminar del grupo al estudiante
     * cuya id sea enviada por parámetro.
     * Escenarios Fallidos:
     *  - Si el usuario no tiene rol de Ayudante o Profesor para dicho curso ->  Se le muestra
     *  un mensaje indicando que no tiene los permisos.
     * @param sfWebRequest $request
     */
    public function executeErase(sfWebRequest $request){
        if($this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
            try{
                Doctrine_Query::create()
                    ->delete()
                    ->from('EstudianteGrupo eg')
                    ->where('eg.idgrupo = ?', $request->getParameter('grupo'))
                    ->andWhere('eg.id_estudiante = ?', $request->getParameter('estudiante'))
                    ->execute();
                $this->mensaje = "Estudiante ha sido eliminado del grupo.";
            }  catch (Exception $e){
                $this->mensaje = "El registro no pudo ser eliminado.";
            }
        }else
            $this->mensaje = $this->getMensajeNoAutorizado();
    }

    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista de grupos
     * que pertenecen al curso actual.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado -> lo redirecciona al Login.
     *  - Si el usuario no tiene rol de Ayudante o Profesor para dicho curso ->  Se lo redirecciona
     *  a la consulta de grupos.
     * @param sfWebRequest $request
     */
    public function executeEdit(sfWebRequest $request) {
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            if($this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
                $id_rol = $this->getIDRol("Estudiante");
                $id_curso = Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
                $this->lista = Doctrine_Core::getTable('Grupo')
                        ->createQuery('g')
                        ->innerJoin('g.Estudiantegrupo eg')
                        ->innerJoin('eg.UsuarioCurso uc')
                        ->where('uc.id_curso = ?',$id_curso)
                        ->andWhere('uc.id_rol = ?', $id_rol)
                        ->execute();
            }else
                $this->redirect('Grupo/index');
        }else{
            $this->redirect('Inicio/index');
        }
    }

    /**
     * Descripción: Función que me permite conectarme a la base y obtener la lista estudiantes del
     * curso actual que no pertenecen a ningún grupo.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado -> lo redirecciona al Login.
     *  - Si el usuario no tiene rol de Ayudante o Profesor para dicho curso ->  Se lo redirecciona
     *  a la consulta de grupos.
     * @param sfWebRequest $request
     */
    public function executeAgregar(sfWebRequest $request){
        if($this->getUser()->hasMateriaActual()&&$this->getUser()->hasParaleloActual()){
            if($this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
                $this->grupo = $request->getParameter('grupo');
                $id_rol = $this->getIDRol("Estudiante");
                $this->id_curso = Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
                $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                        ->createQuery('uc')
                        ->where('uc.id_curso = ?',$this->id_curso)
                        ->andWhere('uc.id_rol = ?', $id_rol)
                        ->execute();
                $this->lista = array();
                foreach ($estudiantes as $objeto)
                    if(Grupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)
                        array_push ($this->lista, $objeto);
                $this->rol = $this->getActualRol()->getNombre();
            }else
                $this->redirect('Grupo/index');
        }else{
            $this->redirect('Inicio/index');
        }
    }
    
    /**
     * Descripción: Función que me permite conectarme a la base y agregar estudiantes a un grupo
     * específico.
     * Escenarios Fallidos:
     *  - Si no se encuetra autenticado -> lo redirecciona al Login.
     *  - Si el usuario no tiene rol de Ayudante o Profesor para dicho curso ->  Se muestra un
     *  mensaje indicando que no posee los permisos.
     * @param sfWebRequest $request
     */
    public function executeAdd(sfWebRequest $request){
        if($this->getActualRol()->getNombre()=="Profesor"||$this->getActualRol()->getNombre()=="Ayudante"){
		// Obtengo los parametros
		$n_estudiantes = $request->getParameter("size");
		$lista = array();
		for($i=0;$i<$n_estudiantes;$i++)
			array_push($lista,$request->getParameter('param'.$i));
		// Verifico que ninguno de los estudiantes seleccionados pertenezca ya a algún grupo
		$bandera = true;
		foreach($lista as $objeto)
			if(Grupo::getGrupoDeEstudiante($objeto)!=null)
				$bandera = false;
		// Ejecuto las siguientes sentencias solo en caso de que ninguno tenga grupo
		if($bandera){
                    $estudiantes = Doctrine_Core::getTable('UsuarioCurso')
                        ->createQuery('uc')
                        ->whereIn('uc.id_usuario_curso', $lista)
                        ->execute();
                    if(sizeof($estudiantes)==sizeof($lista)){
                        try{
                            // A cada estudiante lo vinculo con dicho grupo que recién se creó.
                            foreach($estudiantes as $objeto){
                                // Se crea una relación entre cada UsuarioCurso y el Grupo
                                $eg = new EstudianteGrupo();
                                $eg->setIdGrupo($request->getParameter('grupo'));
                                $eg->setIdEstudiante($objeto->getIdUsuarioCurso());
                                $eg->save();
                            }
                            $this->mensaje = "El estudiante a sido añadido al grupo.";
                        }catch(Exception $e){
                            $this->mensaje = "Error al añadir a los estudiantes a los grupos.".$e->getMessage();
                        }
                    }else
			$this->mensaje = "Uno de los estudiantes no pertenece al curso";
		}else
                    $this->mensaje = "Uno de los estudiantes seleccionados ya pertenece a algún grupo";
        }else
            $this->mensaje = $this->getMensajeNoAutorizado();
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
     * Función que permite obtener el rol del usuario en el curso actual.
     * @return Rolusuario
     */
    private function getActualRol(){
        $id_curso = Grupo::getIdCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
        $id_usuario = $this->getUser()->getUserDB()->getIdusuario();
        $temp =  Doctrine_Core::getTable('UsuarioCurso')
                ->createQuery('uc')
                ->where('uc.id_curso = ?', $id_curso)
                ->andWhere('uc.id_usuario = ?', $id_usuario)
                ->execute();
        return $temp[0]->getRolusuario();
    }
    
    /**
     * Función que retorna un mensaje por defecto cuando se accede a un evento y no
     * se posee los roles adecuados.
     * @return string
     */
    private function getMensajeNoAutorizado(){
        return "Usted no tiene permisos para realizar esta acción";
    }
}
