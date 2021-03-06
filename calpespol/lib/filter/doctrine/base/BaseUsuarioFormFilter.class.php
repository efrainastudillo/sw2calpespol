<?php

/**
 * Usuario filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_espol' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mail'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'matricula'     => new sfWidgetFormFilterInput(),
      'cedula'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'usuario_espol' => new sfValidatorPass(array('required' => false)),
      'nombre'        => new sfValidatorPass(array('required' => false)),
      'apellido'      => new sfValidatorPass(array('required' => false)),
      'mail'          => new sfValidatorPass(array('required' => false)),
      'matricula'     => new sfValidatorPass(array('required' => false)),
      'cedula'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

  public function getFields()
  {
    return array(
      'idusuario'     => 'Number',
      'usuario_espol' => 'Text',
      'nombre'        => 'Text',
      'apellido'      => 'Text',
      'mail'          => 'Text',
      'matricula'     => 'Text',
      'cedula'        => 'Text',
    );
  }
}
