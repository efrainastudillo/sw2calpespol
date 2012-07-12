<?php

/**
 * Estudiantegrupo form base class.
 *
 * @method Estudiantegrupo getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudiantegrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idgrupo'       => new sfWidgetFormInputHidden(),
      'id_estudiante' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'idgrupo'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idgrupo')), 'empty_value' => $this->getObject()->get('idgrupo'), 'required' => false)),
      'id_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estudiante')), 'empty_value' => $this->getObject()->get('id_estudiante'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudiantegrupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiantegrupo';
  }

}
