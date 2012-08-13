<?php

/**
 * Tipoactividad filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTipoactividadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'valor_ponderacion' => new sfWidgetFormFilterInput(),
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parcial'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'es_extra'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'es_grupal'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tiene_factor_1'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tiene_factor_2'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'id_curso'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'idcurso')),
      'valor_ponderacion' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'parcial'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'es_extra'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'es_grupal'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tiene_factor_1'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tiene_factor_2'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('tipoactividad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipoactividad';
  }

  public function getFields()
  {
    return array(
      'idtipoactividad'   => 'Number',
      'id_curso'          => 'ForeignKey',
      'valor_ponderacion' => 'Number',
      'nombre'            => 'Text',
      'parcial'           => 'Number',
      'es_extra'          => 'Boolean',
      'es_grupal'         => 'Boolean',
      'tiene_factor_1'    => 'Boolean',
      'tiene_factor_2'    => 'Boolean',
    );
  }
}
