<?php

/**
 * Materia form base class.
 *
 * @method Materia getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMateriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_codigo' => new sfWidgetFormInputHidden(),
      'nombre'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_codigo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_codigo')), 'empty_value' => $this->getObject()->get('id_codigo'), 'required' => false)),
      'nombre'    => new sfValidatorString(array('max_length' => 400)),
    ));

    $this->widgetSchema->setNameFormat('materia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Materia';
  }

}
