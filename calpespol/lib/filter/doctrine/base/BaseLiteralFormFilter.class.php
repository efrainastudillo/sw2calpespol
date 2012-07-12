<?php

/**
 * Literal filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLiteralFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre_literal'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor_ponderacion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_actividad'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre_literal'    => new sfValidatorPass(array('required' => false)),
      'valor_ponderacion' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_actividad'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Actividad'), 'column' => 'idactividad')),
    ));

    $this->widgetSchema->setNameFormat('literal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Literal';
  }

  public function getFields()
  {
    return array(
      'idliteral'         => 'Number',
      'nombre_literal'    => 'Text',
      'valor_ponderacion' => 'Number',
      'id_actividad'      => 'ForeignKey',
    );
  }
}
