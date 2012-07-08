<?php

/**
 * Grupo filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrupoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'  => new sfWidgetFormFilterInput(),
      'nombre'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'numero'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'  => new sfValidatorPass(array('required' => false)),
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
      'idgrupo' => 'Number',
      'numero'  => 'Number',
      'nombre'  => 'Text',
    );
  }
}
