<?php

/**
 * Materia form base class.
 *
 * @method Materia getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMateriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idmateria'      => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
      'codigo_materia' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idmateria'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idmateria')), 'empty_value' => $this->getObject()->get('idmateria'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 45)),
      'codigo_materia' => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('materia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Materia';
  }

}
