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
      'idestudiantegrupo' => new sfWidgetFormInputHidden(),
      'idgrupo'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'id_estudiante'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idestudiantegrupo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idestudiantegrupo')), 'empty_value' => $this->getObject()->get('idestudiantegrupo'), 'required' => false)),
      'idgrupo'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'required' => false)),
      'id_estudiante'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'), 'required' => false)),
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
