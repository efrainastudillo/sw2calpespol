<?php

/**
 * Categoria form base class.
 *
 * @method Categoria getObject() Returns the current form's model object
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     ABEJJA
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCategoriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_curso'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => false)),
      'nombre'            => new sfWidgetFormInputText(),
      'periodo'           => new sfWidgetFormInputText(),
      'porcentaje'        => new sfWidgetFormInputText(),
      'id_tipo_categoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocategoria'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'id_curso'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'))),
      'nombre'            => new sfValidatorString(array('max_length' => 200)),
      'periodo'           => new sfValidatorInteger(),
      'porcentaje'        => new sfValidatorInteger(),
      'id_tipo_categoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipocategoria'))),
    ));

    $this->widgetSchema->setNameFormat('categoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categoria';
  }

}
