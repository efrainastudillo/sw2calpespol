<?php

/**
 * Rubrica actions.
 *
 * @package    CALPESPOL
 * @subpackage Rubrica
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RubricaActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  { 
    $this->items = ItemTable::
                    obtenerItemsXIdActividad($request);
    
    $this->actividad = ActividadTable::
                        obtenerActividadXIdItem($this->items[0]->getIdActividad());
    
    $this->tipo_calificacion = TipocalificacionTable::
                                obtenerTCalificacionXIdActividad($this->actividad[0]->getId());
    
    $this->categoria = CategoriaTable::
                        obtenerCategoriaXIdActividad($this->actividad[0]->getId());
    
    $this->tipo_categoria = TipocategoriaTable::
                             obtenerTCategoriaXIdCategoria($this->categoria[0]->getId());
    
    $this-> variable = $request->getParameter("q");
    
//    echo $this-> variable;
            
  }
  
  public function executeNewRubrica(sfWebRequest $request){
      
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new itemForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new itemForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($item = Doctrine_Core::getTable('item')->find(array($request->getParameter('id'))), sprintf('Object item does not exist (%s).', $request->getParameter('id')));
    $this->form = new itemForm($item);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($item = Doctrine_Core::getTable('item')->find(array($request->getParameter('id'))), sprintf('Object item does not exist (%s).', $request->getParameter('id')));
    $this->form = new itemForm($item);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($item = Doctrine_Core::getTable('item')->find(array($request->getParameter('id'))), sprintf('Object item does not exist (%s).', $request->getParameter('id')));
    $item->delete();

    $this->redirect('Rubrica/index');
  }

  public function executeProcess(sfWebRequest $request){
      $item_literal = new Item();
      $item_literal->grabarItem($request);
      $texto=$item_literal->createMessage("Item grabado con Exito");
      return $this->renderText($texto);
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $item = $form->save();

      $this->redirect('Rubrica/edit?id='.$item->getId());
    }
  }
  
  
  
}
