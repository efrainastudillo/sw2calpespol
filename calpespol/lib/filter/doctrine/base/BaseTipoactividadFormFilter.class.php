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
    ));

    $this->setValidators(array(
      'id_curso'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'idcurso')),
      'valor_ponderacion' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'            => new sfValidatorPass(array('required' => false)),
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
    );
  }
}
