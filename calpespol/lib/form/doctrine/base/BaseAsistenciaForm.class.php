<?php

/**
 * Asistencia form base class.
 *
 * @method Asistencia getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idasistencia'       => new sfWidgetFormInputHidden(),
      'fecha'              => new sfWidgetFormDateTime(),
      'id_tipo_asistencia' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoasistencia'), 'add_empty' => false)),
      'id_estudiante'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idasistencia'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idasistencia')), 'empty_value' => $this->getObject()->get('idasistencia'), 'required' => false)),
      'fecha'              => new sfValidatorDateTime(),
      'id_tipo_asistencia' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipoasistencia'))),
      'id_estudiante'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'))),
    ));

    $this->widgetSchema->setNameFormat('asistencia[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asistencia';
  }

}
