<?php

/**
 * Actividad form base class.
 *
 * @method Actividad getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActividadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idactividad'       => new sfWidgetFormInputHidden(),
      'nombre'            => new sfWidgetFormInputText(),
      'es_grupal'         => new sfWidgetFormInputText(),
      'fecha_entrega'     => new sfWidgetFormDateTime(),
      'id_tipo_actividad' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoactividad'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idactividad'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idactividad')), 'empty_value' => $this->getObject()->get('idactividad'), 'required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'es_grupal'         => new sfValidatorInteger(),
      'fecha_entrega'     => new sfValidatorDateTime(),
      'id_tipo_actividad' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoactividad'))),
    ));

    $this->widgetSchema->setNameFormat('actividad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actividad';
  }

}
