<?php

/**
 * Calificacion filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCalificacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'valor'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_usuario'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id')),
      'valor'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fecha'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calificacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calificacion';
  }

  public function getFields()
  {
    return array(
      'id_estudiante' => 'Text',
      'id_item'       => 'Number',
      'id_usuario'    => 'ForeignKey',
      'valor'         => 'Number',
      'fecha'         => 'Text',
    );
  }
}
