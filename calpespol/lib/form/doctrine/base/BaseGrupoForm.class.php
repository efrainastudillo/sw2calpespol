<?php

/**
 * Grupo form base class.
 *
 * @method Grupo getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idgrupo' => new sfWidgetFormInputHidden(),
      'numero'  => new sfWidgetFormInputText(),
      'nombre'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idgrupo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idgrupo')), 'empty_value' => $this->getObject()->get('idgrupo'), 'required' => false)),
      'numero'  => new sfValidatorInteger(array('required' => false)),
      'nombre'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupo';
  }

}
