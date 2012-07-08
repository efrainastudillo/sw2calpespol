<?php

/**
 * Categoria filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'periodo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'porcentaje'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_categoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocategoria'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_curso'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id')),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'periodo'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'porcentaje'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_categoria' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipocategoria'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('categoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categoria';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'id_curso'          => 'ForeignKey',
      'nombre'            => 'Text',
      'periodo'           => 'Number',
      'porcentaje'        => 'Number',
      'id_tipo_categoria' => 'ForeignKey',
    );
  }
}
