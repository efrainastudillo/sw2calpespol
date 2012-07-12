<?php

/**
 * Grupo filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrupoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'numero'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_curso' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id')),
      'numero'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('grupo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupo';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'id_curso' => 'ForeignKey',
      'numero'   => 'Number',
    );
  }
}
