<?php

/**
 * Actividad form base class.
 *
 * @method Actividad getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActividadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_categoria'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categoria'), 'add_empty' => false)),
      'nombre'               => new sfWidgetFormInputText(),
      'fecha'                => new sfWidgetFormInputText(),
      'id_tipo_calificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocalificacion'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_categoria'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categoria'))),
      'nombre'               => new sfValidatorString(array('max_length' => 200)),
      'fecha'                => new sfValidatorPass(),
      'id_tipo_calificacion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocalificacion'))),
    ));

    $this->widgetSchema->setNameFormat('actividad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Actividad';
  }

}
