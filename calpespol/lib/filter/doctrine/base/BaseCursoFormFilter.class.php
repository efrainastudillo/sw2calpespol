<?php

/**
 * Curso filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'paralelo'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'anio'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'termino'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_materia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materia'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'paralelo'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'anio'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'termino'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_materia' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Materia'), 'column' => 'idmateria')),
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
      'idcurso'    => 'Number',
      'paralelo'   => 'Number',
      'anio'       => 'Number',
      'termino'    => 'Number',
      'id_materia' => 'ForeignKey',
    );
  }
}
