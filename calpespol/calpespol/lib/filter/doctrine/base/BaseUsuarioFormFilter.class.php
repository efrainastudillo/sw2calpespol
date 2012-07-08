<?php

/**
 * Usuario filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mail'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_rol' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rolusuario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre' => new sfValidatorPass(array('required' => false)),
      'mail'   => new sfValidatorPass(array('required' => false)),
      'id_rol' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rolusuario'), 'column' => 'id')),
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
      'id'     => 'Text',
      'nombre' => 'Text',
      'mail'   => 'Text',
      'id_rol' => 'ForeignKey',
    );
  }
}
