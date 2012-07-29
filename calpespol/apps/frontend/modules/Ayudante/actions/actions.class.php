<?php

/**
 * Ayudante actions.
 *
 * @package    CALPESPOL
 * @subpackage Ayudante
 * @author     Efrain Astudillo
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AyudanteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->ayudantes=Usuario::getAyudantesCurso($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
      if($this->ayudantes->count()==0){
          $this->getUser()->setFlash('mensaje', 'El Curso No tiene Ayudantes');
      }
  }
  public function executeNew(sfWebRequest $request){
      
  }
  
  /**
   *
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
      $id       =$request->getParameter("id");
      $paralelo =$request->getParameter("paralelo");
      $nombres  =$request->getParameter("nombres");
      $apellidos=$request->getParameter("apellidos");
      $userespol=$request->getParameter("userespol");
      $correo   =$request->getParameter("correo");
      $matricula=$request->getParameter("matricula");
      $cedula   =$request->getParameter("cedula");
      if(Usuario::existeUsuario($matricula) || Usuario::existeUsuario($userespol)){
        $this->getUser()->setFlash('nuevo_ayudante', 'Usuario YA Existe en el Sistema');
        $this->redirect("Ayudante/new");
      }
      
      $estudiante=new Usuario();
      $estudiante->setNombre($nombres);
      $estudiante->setApellido($apellidos);
      $estudiante->setMail($correo);
      $estudiante->setMatricula($matricula);
      $estudiante->setCedula($cedula);
      $estudiante->setUsuarioEspol($userespol);
      $estudiante->save();
      $curso= Curso::getCursoByParaleloAndMateria($this->getUser()->getParaleloActual(), $this->getUser()->getMateriaActual());
      $usuarioCurso=new UsuarioCurso();
      $usuarioCurso->setUsuario($estudiante);
      $usuarioCurso->setCurso($curso);
      $usuarioCurso->setRolusuario(Rolusuario::getRolUsuario("Ayudante"));
      $usuarioCurso->save();
      //coloca el mensaje exitoso
      $this->getUser()->setFlash('nuevo_ayudante', 'Usuario Creado Exitosamente');
      $this->redirect("Ayudante/new");
  }
  public function executeDelete(sfWebRequest $request)
  {
    $id=$request->getParameter('id');
    if($id==$this->getUser()->getUserDB()->getIdusuario()){
        $this->getUser()->setFlash('mensaje', 'No se Puede Eliminar (Usuario Actual)');
    }else{
        $this->forward404Unless($estudiante = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('id')));
        $estudiante->delete();
        $this->getUser()->setFlash('mensaje', 'Usuario Eliminado Correctamente');
    }
    $this->redirect('Ayudante/index');
  }
}
