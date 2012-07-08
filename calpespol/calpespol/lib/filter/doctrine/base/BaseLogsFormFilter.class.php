<?php

/**
 * Logs filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLogsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nota_anterior' => new sfWidgetFormFilterInput(),
      'nota_nueva'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_usuario'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nota_anterior' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nota_nueva'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fecha'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('logs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Logs';
  }

  public function getFields()
  {
    return array(
      'id_estudiante' => 'Number',
      'id_item'       => 'Number',
      'id_usuario'    => 'Number',
      'nota_anterior' => 'Number',
      'nota_nueva'    => 'Number',
      'fecha'         => 'Text',
    );
  }
}
