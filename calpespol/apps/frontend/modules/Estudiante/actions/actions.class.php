<?php

/**
 * Estudiante actions.
 *
 * @package    CALPESPOL
 * @subpackage Estudiante
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EstudianteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      try {
           $this->estudiantes = Doctrine_Core::getTable('Usuario')
          ->createQuery('a')
          ->execute();
      } catch (Exception $exc) {
          //echo $exc->getTraceAsString();
      }
  }

  public function executeNew(sfWebRequest $request)
  {     
      
      
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EstudianteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estudiante = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsuarioForm($estudiante);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estudiante = Doctrine_Core::getTable('Estudiante')->find(array($request->getParameter('id'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('id')));
    $this->form = new EstudianteForm($estudiante);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();
    $this->forward404Unless($estudiante = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object estudiante does not exist (%s).', $request->getParameter('id')));
    $estudiante->delete();
    $this->redirect('Estudiante/index');
  }
  public function executeProcess(sfWebRequest $request){
      $usuario=new Usuario();
      $usuario->grabarEstudiante($request);
      $texto=$usuario->createMessage("Estudiante grabado con Exito");
      return $this->renderText($texto);
  }
}
