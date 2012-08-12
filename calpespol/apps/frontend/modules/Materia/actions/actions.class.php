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
      $this->materias=Doctrine_Query::create()
              ->from("Materia m")
              ->execute();
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
}
