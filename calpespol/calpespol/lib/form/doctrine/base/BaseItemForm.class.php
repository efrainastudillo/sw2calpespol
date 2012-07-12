<?php

/**
 * Item form base class.
 *
 * @method Item getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_actividad' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'), 'add_empty' => false)),
      'literal'      => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormTextarea(),
      'valor_max'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_actividad' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Actividad'))),
      'literal'      => new sfValidatorInteger(),
      'nombre'       => new sfValidatorString(array('max_length' => 400)),
      'valor_max'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

}
