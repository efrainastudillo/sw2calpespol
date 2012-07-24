<?php

/**
 * Nota actions.
 *
 * @package    CALPESPOL
 * @subpackage Nota
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NotaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->estudianteliterals = Doctrine_Core::getTable('estudianteliteral')
      ->createQuery('a')
      ->execute();
    
    $this->materia = Materia::getMaterias();
    $this->curso = Curso::getParalelos();
    $this->actividad = Actividad::getActividades();
    $this->literal = Literal::getLiterales();
    $this->usuario = Usuario::getUsuarioByMatricula($this->getUser()->getMatricula());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new estudianteliteralForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new estudianteliteralForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $this->form = new estudianteliteralForm($estudianteliteral);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $this->form = new estudianteliteralForm($estudianteliteral);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($estudianteliteral = Doctrine_Core::getTable('estudianteliteral')->find(array($request->getParameter('id_estudiante'),
         $request->getParameter('idliteral'))), sprintf('Object estudianteliteral does not exist (%s).', $request->getParameter('id_estudiante'),
         $request->getParameter('idliteral')));
    $estudianteliteral->delete();

    $this->redirect('Nota/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $estudianteliteral = $form->save();

      $this->redirect('Nota/edit?id_estudiante='.$estudianteliteral->getIdEstudiante().'&idliteral='.$estudianteliteral->getIdliteral());
    }
  }
}
