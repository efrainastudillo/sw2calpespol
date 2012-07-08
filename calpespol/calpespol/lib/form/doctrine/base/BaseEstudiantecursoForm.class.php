<?php

/**
 * Estudiantecurso form base class.
 *
 * @method Estudiantecurso getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudiantecursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'   => new sfWidgetFormInputHidden(),
      'id_usuario' => new sfWidgetFormInputHidden(),
      'id_grupo'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_curso'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_curso')), 'empty_value' => $this->getObject()->get('id_curso'), 'required' => false)),
      'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_grupo'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiantecurso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiantecurso';
  }

}
