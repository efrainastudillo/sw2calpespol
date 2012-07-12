<?php

/**
 * Item filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_actividad' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'), 'add_empty' => true)),
      'literal'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor_max'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_actividad' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Actividad'), 'column' => 'id')),
      'literal'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'valor_max'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_actividad' => 'ForeignKey',
      'literal'      => 'Number',
      'nombre'       => 'Text',
      'valor_max'    => 'Number',
    );
  }
}
