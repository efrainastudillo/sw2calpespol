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
//          ->select('c.idcurso as idcurso, m.nombre as nombre, c.paralelo as paralelo, r.nombre as rol')
          ->from('UsuarioCurso uc')
          ->innerJoin('uc.Usuario u')
          ->innerJoin('uc.Curso c')
          ->innerJoin('uc.Rolusuario r')
          ->innerJoin('c.Materia m')
          ->where('u.usuario_espol = ?', $this->getUser()->getUserEspol())
          ->execute();
        /*if(sizeof($this->consulta)!=0){
            $cursos = array();
            for($i=0;$i<sizeof($this->consulta);$i++)
                array_push($cursos, $this->consulta[$i]->idcurso);
            $this->profesores = Doctrine_Query::create()
              ->select('CONCAT(u.nombre," ",u.apellido) as profesor')
              ->from('UsuarioCurso uc')
              ->addFrom('uc.Usuario u')
              ->addFrom('uc.Rolusuario r')
              ->where('r.nombre = ?', 'Profesor')
              ->andWhereIn('uc.id_curso', $cursos)
              ->execute();
        }*/
      }else
        $this->redirect('Inicio/index');
        
  }
  
  public function executeNew(sfWebRequest $request)
  {
      
  }
  public function executeCreate(sfWebRequest $request)
  {
      $nombre=$request->getParameter("nombres");
      $codigo=$request->getParameter("codigo");
      
      $materia=new Materia();
      $materia->setNombre($nombre);
      $materia->setCodigoMateria($codigo);
      $materia->save();
      $this->getUser()->setFlash('materia_creada','Materia Creada Exitosamente');
      $this->redirect("Materia/index");
  }
  public function executeDelete(sfWebRequest $request)
  {
       $id=$request->getParameter("id");
       $m=Doctrine_Query::create()
               ->from("Materia m")
               ->where('m.idmateria=?',$id)
               ->fetchOne();
      
      
           $m->delete();
           $this->getUser()->setFlash('materia_creada','Materia Eliminada Exitosamente');
    
       $this->redirect("Materia/index");
  }
  
  
    
    /**
     * Función que permite obtener el rol del usuario en el curso actual.
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
