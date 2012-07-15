<?php

/**
 * Tipoactividad form base class.
 *
 * @method Tipoactividad getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoactividadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idtipoactividad'   => new sfWidgetFormInputHidden(),
      'id_curso'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => false)),
      'valor_ponderacion' => new sfWidgetFormInputText(),
      'nombre'            => new sfWidgetFormInputText(),
      'parcial'           => new sfWidgetFormInputText(),
      'es_extra'          => new sfWidgetFormInputCheckbox(),
      'es_grupal'         => new sfWidgetFormInputText(),
      'factor_asist_1'    => new sfWidgetFormInputText(),
      'factor_asist_2'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idtipoactividad'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idtipoactividad')), 'empty_value' => $this->getObject()->get('idtipoactividad'), 'required' => false)),
      'id_curso'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'))),
      'valor_ponderacion' => new sfValidatorInteger(array('required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 45)),
      'parcial'           => new sfValidatorInteger(),
      'es_extra'          => new sfValidatorBoolean(),
      'es_grupal'         => new sfValidatorInteger(),
      'factor_asist_1'    => new sfValidatorInteger(array('required' => false)),
      'factor_asist_2'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipoactividad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipoactividad';
  }

}
