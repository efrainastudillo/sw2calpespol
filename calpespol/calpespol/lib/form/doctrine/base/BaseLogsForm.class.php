<?php

/**
 * Logs form base class.
 *
 * @method Logs getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLogsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_estudiante' => new sfWidgetFormInputHidden(),
      'id_item'       => new sfWidgetFormInputHidden(),
      'id_usuario'    => new sfWidgetFormInputText(),
      'nota_anterior' => new sfWidgetFormInputText(),
      'nota_nueva'    => new sfWidgetFormInputText(),
      'fecha'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estudiante')), 'empty_value' => $this->getObject()->get('id_estudiante'), 'required' => false)),
      'id_item'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_item')), 'empty_value' => $this->getObject()->get('id_item'), 'required' => false)),
      'id_usuario'    => new sfValidatorInteger(),
      'nota_anterior' => new sfValidatorNumber(array('required' => false)),
      'nota_nueva'    => new sfValidatorNumber(),
      'fecha'         => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('logs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Logs';
  }

}
