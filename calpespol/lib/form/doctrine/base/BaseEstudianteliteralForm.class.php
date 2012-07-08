<?php

/**
 * Estudianteliteral form base class.
 *
 * @method Estudianteliteral getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteliteralForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_estudiante'  => new sfWidgetFormInputHidden(),
      'idliteral'      => new sfWidgetFormInputHidden(),
      'nota_literal'   => new sfWidgetFormInputText(),
      'id_calificador' => new sfWidgetFormInputText(),
      'fecha'          => new sfWidgetFormDateTime(),
      'comentario'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_estudiante'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estudiante')), 'empty_value' => $this->getObject()->get('id_estudiante'), 'required' => false)),
      'idliteral'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idliteral')), 'empty_value' => $this->getObject()->get('idliteral'), 'required' => false)),
      'nota_literal'   => new sfValidatorInteger(array('required' => false)),
      'id_calificador' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fecha'          => new sfValidatorDateTime(),
      'comentario'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudianteliteral[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudianteliteral';
  }

}
