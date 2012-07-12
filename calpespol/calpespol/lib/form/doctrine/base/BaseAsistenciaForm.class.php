<?php

/**
 * Asistencia form base class.
 *
 * @method Asistencia getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsistenciaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'   => new sfWidgetFormInputHidden(),
      'id_usuario' => new sfWidgetFormInputHidden(),
      'fecha'      => new sfWidgetFormInputText(),
      'valor'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_curso'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_curso')), 'empty_value' => $this->getObject()->get('id_curso'), 'required' => false)),
      'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'fecha'      => new sfValidatorPass(),
      'valor'      => new sfValidatorString(array('max_length' => 1)),
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
