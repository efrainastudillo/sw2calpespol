<?php

/**
 * Ayudantecurso filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAyudantecursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'estado'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'estado'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ayudantecurso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ayudantecurso';
  }

  public function getFields()
  {
    return array(
      'id_curso'   => 'Number',
      'id_usuario' => 'Text',
      'estado'     => 'Number',
    );
  }
}
