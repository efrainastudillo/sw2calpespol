<?php

/**
 * Estudiante actions.
 * 
 * @package    CALPESPOL
 * @subpackage Estudiante
 * @author     Efrain Astudillo
 * @version    1.0
 */
class EstudianteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      try {
           $this->estudiantes = Usuario::getEstudiantesByParaleloAndMateria('1', $this->getUser()->getMateriaActual());
      } catch (Exception $exc) {
          //
      }
  }

  public function executeNew(sfWebRequest $request)
  {     
      //No hace Nada
      
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
      $estudiante=new Usuario();
      $estudiante->setNombre($nombres);
      $estudiante->setApellido($apellidos);
      $estudiante->setMail($correo);
      $estudiante->setMatricula($matricula);
      $estudiante->setCedula($cedula);
      $estudiante->setUsuarioEspol($userespol);
      $estudiante->save();
      $curso= Curso::getCursoByParaleloAndMateria($paralelo, $this->getUser()->getMateriaActual());
      $usuarioCurso=new UsuarioCurso();
      $usuarioCurso->setUsuario($estudiante);
      $usuarioCurso->setCurso($curso);
      $usuarioCurso->setRolusuario(Rolusuario::getRolUsuario("Estudiante"));
      $usuarioCurso->save();
      //coloca el mensaje exitoso
      $this->getUser()->setFlash('mensaje', 'Usuario Creado Exitosamente');
      $this->redirect("Estudiante/new");
  }

  public function executeEdit(sfWebRequest $request)
  {
      $this->estudiante = Doctrine_Query::create()
            ->select("*")
            ->from('Usuario u')
            ->where('u.idusuario = ?', $request->getParameter("id"))
            ->fetchOne();
    
    $this->forward404Unless($this->estudiante);
    //$this->form = new UsuarioForm($estudiante);
  }

  public function executeUpdate(sfWebRequest $request)
  {
      $id       =$request->getParameter("id");
      $nombres  =$request->getParameter("nombres");
      $apellidos=$request->getParameter("apellidos");
      $userespol=$request->getParameter("userespol");
      $correo   =$request->getParameter("correo");
      $matricula=$request->getParameter("matricula");
      $cedula   =$request->getParameter("cedula");
      $estudiante = Doctrine_Query::create()
            ->select("*")
            ->from('Usuario u')
            ->where('u.idusuario = ?', $id)
            ->fetchOne();
      $estudiante->setNombre($nombres);
      $estudiante->setApellido($apellidos);
      $estudiante->setMail($correo);
      $estudiante->setMatricula($matricula);
      $estudiante->setCedula($cedula);
      $estudiante->setUsuarioEspol($userespol);
      $estudiante->save();
       $this->getUser()->setFlash('mensaje', 'Usuario Actualizado Exitosamente');
      $this->redirect("Estudiante/index");
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
    $this->redirect('Estudiante/index');
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
//    if ($form->isValid())
//    {
      $usuario = $form->save();
      $this->getUser()->setFlash('mensaje','Usuario se Actualizo correctamente');
      //$this->redirect('Estudiante/edit?id='.$usuario->getIdUsuario());
      $this->redirect('Estudiante/index');
//    }
  }

}
