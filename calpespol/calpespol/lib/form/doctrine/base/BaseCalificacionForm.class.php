<?php

/**
 * Calificacion form base class.
 *
 * @method Calificacion getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCalificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_estudiante' => new sfWidgetFormInputHidden(),
      'id_item'       => new sfWidgetFormInputHidden(),
      'id_usuario'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'valor'         => new sfWidgetFormInputText(),
      'fecha'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estudiante')), 'empty_value' => $this->getObject()->get('id_estudiante'), 'required' => false)),
      'id_item'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_item')), 'empty_value' => $this->getObject()->get('id_item'), 'required' => false)),
      'id_usuario'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'valor'         => new sfValidatorNumber(),
      'fecha'         => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('calificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Calificacion';
  }

}
