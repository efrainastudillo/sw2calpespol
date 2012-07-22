<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idusuario'     => new sfWidgetFormInputHidden(),
      'usuario_espol' => new sfWidgetFormInputText(),
      'nombre'        => new sfWidgetFormInputText(),
      'apellido'      => new sfWidgetFormInputText(),
      'mail'          => new sfWidgetFormInputText(),
      'matricula'     => new sfWidgetFormInputText(),
      'cedula'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idusuario'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idusuario')), 'empty_value' => $this->getObject()->get('idusuario'), 'required' => false)),
      'usuario_espol' => new sfValidatorString(array('max_length' => 45)),
      'nombre'        => new sfValidatorString(array('max_length' => 45)),
      'apellido'      => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'mail'          => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'matricula'     => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'cedula'        => new sfValidatorString(array('max_length' => 10, 'required' => true)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
