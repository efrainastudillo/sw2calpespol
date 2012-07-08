<?php

/**
 * Curso filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'anio'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'termino'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_materia'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'), 'add_empty' => true)),
      'paralelo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'profesor'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'factor_asistencia1' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'factor_asistencia2' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'anio'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'termino'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_materia'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materia'), 'column' => 'id_codigo')),
      'paralelo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'profesor'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'factor_asistencia1' => new sfValidatorPass(array('required' => false)),
      'factor_asistencia2' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('curso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'anio'               => 'Number',
      'termino'            => 'Number',
      'id_materia'         => 'ForeignKey',
      'paralelo'           => 'Number',
      'profesor'           => 'ForeignKey',
      'factor_asistencia1' => 'Text',
      'factor_asistencia2' => 'Text',
    );
  }
}
