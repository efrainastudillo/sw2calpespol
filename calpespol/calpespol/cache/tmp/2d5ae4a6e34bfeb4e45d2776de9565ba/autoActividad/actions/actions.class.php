<?php

/**
 * actividad actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage actividad
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class autoActividadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->actividads = Doctrine_Core::getTable('actividad')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new actividadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new actividadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($actividad = Doctrine_Core::getTable('actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $this->form = new actividadForm($actividad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($actividad = Doctrine_Core::getTable('actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $this->form = new actividadForm($actividad);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($actividad = Doctrine_Core::getTable('actividad')->find(array($request->getParameter('id'))), sprintf('Object actividad does not exist (%s).', $request->getParameter('id')));
    $actividad->delete();

    $this->redirect('actividad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $actividad = $form->save();

      $this->redirect('actividad/edit?id='.$actividad->getId());
    }
  }
}
