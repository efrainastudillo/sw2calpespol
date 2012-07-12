<?php

/**
 * UsuarioCurso form base class.
 *
 * @method UsuarioCurso getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario_curso' => new sfWidgetFormInputHidden(),
      'id_curso'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'id_usuario'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_rol'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rolusuario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_usuario_curso' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario_curso')), 'empty_value' => $this->getObject()->get('id_usuario_curso'), 'required' => false)),
      'id_curso'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'required' => false)),
      'id_usuario'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'id_rol'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rolusuario'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioCurso';
  }

}
