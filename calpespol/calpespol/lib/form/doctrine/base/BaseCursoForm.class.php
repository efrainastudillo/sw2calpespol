<?php

/**
 * Curso form base class.
 *
 * @method Curso getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'anio'               => new sfWidgetFormInputText(),
      'termino'            => new sfWidgetFormInputText(),
      'id_materia'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'), 'add_empty' => false)),
      'paralelo'           => new sfWidgetFormInputText(),
      'profesor'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'factor_asistencia1' => new sfWidgetFormInputText(),
      'factor_asistencia2' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'anio'               => new sfValidatorInteger(),
      'termino'            => new sfValidatorInteger(),
      'id_materia'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'))),
      'paralelo'           => new sfValidatorInteger(),
      'profesor'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'factor_asistencia1' => new sfValidatorString(array('max_length' => 1)),
      'factor_asistencia2' => new sfValidatorString(array('max_length' => 1)),
    ));

    $this->widgetSchema->setNameFormat('curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

}
