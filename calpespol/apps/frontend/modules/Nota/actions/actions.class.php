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
    $user=$this->getUser()->getUserDB();
    $this->materia = Materia::getMaterias();
    $this->curso = Curso::getParalelosOfUsuarioByMateria($this->getUser()->getMateriaActual(), $user->getIdusuario());
    $this->actividad = Actividad::getActividades();
    $this->literal = Literal::getLiterales();
    $this->usuario = Doctrine_Query::create()
            ->from('Usuario u')
            ->innerJoin('u.UsuarioCurso uc on uc.id_usuario=u.idUsuario')
            ->innerJoin('uc.Curso c on uc.id_curso=c.idCurso')
            ->innerJoin('c.Materia m on c.id_materia=m.idMateria')
            ->innerJoin('uc.Rolusuario ru on uc.id_rol=ru.idrolusuario') 
            ->where('m.nombre=?',$this->getUser()->getMateriaActual())
            ->andWhere('c.anio=?', '2012')
            ->andWhere('c.termino=?', '1')
            ->andWhere('ru.nombre=?', 'Estudiante')
            ->execute();
            
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
