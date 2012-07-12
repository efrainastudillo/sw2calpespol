<?php

/**
 * Literal form base class.
 *
 * @method Literal getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLiteralForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idliteral'         => new sfWidgetFormInputHidden(),
      'nombre_literal'    => new sfWidgetFormInputText(),
      'valor_ponderacion' => new sfWidgetFormInputText(),
      'id_actividad'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idliteral'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idliteral')), 'empty_value' => $this->getObject()->get('idliteral'), 'required' => false)),
      'nombre_literal'    => new sfValidatorString(array('max_length' => 70)),
      'valor_ponderacion' => new sfValidatorNumber(),
      'id_actividad'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'))),
    ));

    $this->widgetSchema->setNameFormat('literal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Literal';
  }

}
