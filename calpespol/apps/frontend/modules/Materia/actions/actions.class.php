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
      $nombre=$request->getParameter("nombres");
      $codigo=$request->getParameter("codigo");
      
      $materia=new Materia();
      $materia->setNombre($nombre);
      $materia->setCodigoMateria($codigo);
      $materia->save();
      $this->getUser()->setFlash('materia_creada','Materia Creada Exitosamente');
      $this->redirect("Materia/index");
  }
}
