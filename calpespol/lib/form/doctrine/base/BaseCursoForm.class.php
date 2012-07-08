<?php

/**
 * Curso form base class.
 *
 * @method Curso getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcurso'        => new sfWidgetFormInputHidden(),
      'paralelo'       => new sfWidgetFormInputText(),
      'anio'           => new sfWidgetFormInputText(),
      'termino'        => new sfWidgetFormInputText(),
      'factor_asist_1' => new sfWidgetFormInputText(),
      'factor_asist_2' => new sfWidgetFormInputText(),
      'id_materia'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idcurso'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcurso')), 'empty_value' => $this->getObject()->get('idcurso'), 'required' => false)),
      'paralelo'       => new sfValidatorInteger(),
      'anio'           => new sfValidatorInteger(),
      'termino'        => new sfValidatorInteger(),
      'factor_asist_1' => new sfValidatorInteger(array('required' => false)),
      'factor_asist_2' => new sfValidatorInteger(array('required' => false)),
      'id_materia'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'))),
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
