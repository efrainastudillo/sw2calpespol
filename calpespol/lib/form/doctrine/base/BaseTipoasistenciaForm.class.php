<?php

/**
 * Tipoasistencia form base class.
 *
 * @method Tipoasistencia getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoasistenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtipoasistencia' => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idtipoasistencia' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtipoasistencia')), 'empty_value' => $this->getObject()->get('idtipoasistencia'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('tipoasistencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipoasistencia';
  }

}
