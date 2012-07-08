<?php

/**
 * Rolusuario form base class.
 *
 * @method Rolusuario getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRolusuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idrolusuario' => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idrolusuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idrolusuario')), 'empty_value' => $this->getObject()->get('idrolusuario'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('rolusuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rolusuario';
  }

}
