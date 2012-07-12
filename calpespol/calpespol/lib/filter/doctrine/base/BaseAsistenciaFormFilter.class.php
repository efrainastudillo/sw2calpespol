<?php

/**
 * Asistencia filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'valor'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'fecha'      => new sfValidatorPass(array('required' => false)),
      'valor'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('asistencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asistencia';
  }

  public function getFields()
  {
    return array(
      'id_curso'   => 'Number',
      'id_usuario' => 'Text',
      'fecha'      => 'Text',
      'valor'      => 'Text',
    );
  }
}
