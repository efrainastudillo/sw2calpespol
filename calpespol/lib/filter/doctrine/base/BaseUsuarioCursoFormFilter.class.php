<?php

/**
 * UsuarioCurso filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioCursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'id_usuario'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_rol'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rolusuario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_curso'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'idcurso')),
      'id_usuario'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'idusuario')),
      'id_rol'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rolusuario'), 'column' => 'idrolusuario')),
    ));

    $this->widgetSchema->setNameFormat('usuario_curso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioCurso';
  }

  public function getFields()
  {
    return array(
      'id_usuario_curso' => 'Number',
      'id_curso'         => 'ForeignKey',
      'id_usuario'       => 'ForeignKey',
      'id_rol'           => 'ForeignKey',
    );
  }
}
