<?php

/**
 * Materia actions.
 *
 * @package    CALPESPOL
 * @subpackage Materia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MateriaActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      if($this->getUser()->getUserEspol()!=null){
        $this->consulta = Doctrine_Query::create()
          ->from('UsuarioCurso uc')
          ->innerJoin('uc.Usuario u')
          ->innerJoin('uc.Curso c')
          ->innerJoin('uc.Rolusuario r')
          ->innerJoin('c.Materia m')
          ->where('u.usuario_espol = ?', $this->getUser()->getUserEspol())
          ->execute();
        if(sizeof($this->consulta)!=0){
            $this->profesores = array();
            foreach($this->consulta as $row){
                $tmp = Doctrine_Query::create()
                  ->from('UsuarioCurso uc')
                  ->addFrom('uc.Usuario u')
                  ->addFrom('uc.Rolusuario r')
                  ->where('r.nombre = ?', 'Profesor')
                  ->andWhere('uc.id_curso = ?', $row->getCurso()->getIdcurso())
                  ->execute();
                array_push($this->profesores, ($tmp==null)?"":$tmp[0]->getUsuario()->getNombre()." ".$tmp[0]->getUsuario()->getApellido());
            }
        }
      }else
        $this->redirect('Inicio/index');
        
  }
  
  public function executeNew(sfWebRequest $request)
  {
      
  }
  
  public function executeCreate(sfWebRequest $request)
  {
      $nombre=$request->getParameter("nombre");
      $codigo=$request->getParameter("codigo");
      $user_profesor=$request->getParameter("profesor");
      $paralelo=$request->getParameter("paralelo");
      $tipo=$request->getParameter("tipo");
      $materia = null;
      if("Nombre"==$tipo){
        $materias = Doctrine_Query::create()
          ->from('Materia m')
          ->where('m.nombre = ?', $nombre)
          ->execute();
        $materia = $materias[0];
      }else{
        $materias = Doctrine_Query::create()
          ->from('Materia m')
          ->where('m.codigo_materia = ?', $codigo)
          ->execute();
        $materia = $materias[0];
      }
      if(null==$materia){
        $materia = new Materia();
        $materia->setNombre(($tipo=="Nombre")?$nombre:$this->getNombreFromCodigo($codigo));
        $materia->setCodigoMateria(($tipo=="Nombre")?"00000":$codigo);
      }
      $curso=new Curso();
      $curso->setMateria($materia);
      $curso->setAnio(Utility::getAnio());
      $curso->setTermino(Utility::getTermino());
      $curso->setParalelo($paralelo);
      $profesores = Doctrine_Query::create()
          ->from('Usuario u')
          ->where('u.usuario_espol = ?', $user_profesor)
          ->execute();
      $profesor = $profesores[0];
      if(null==$profesor){
          $profesor = new Usuario();
          $profesor->setUsuarioEspol($user_profesor);
      }
      $curso->setProfesor($profesor);
      $estudiante = new UsuarioCurso();
      $estudiante->setCurso($curso);
      $estudiante->setIdRol($this->getIDRol("Profesor"));
      $estudiante->setUsuario($profesor);
      $estudiante->save();
      $this->getUser()->setFlash('materia_creada','Curso Creado Exitosamente');
      $this->redirect("Materia/index");
  }
  
  private function getNombreFromCodigo($codigo){
      
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
}
