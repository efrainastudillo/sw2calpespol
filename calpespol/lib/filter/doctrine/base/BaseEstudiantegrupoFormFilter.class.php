<?php

/**
 * Estudiantegrupo filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudiantegrupoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idgrupo'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'add_empty' => true)),
      'id_estudiante'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCurso'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idgrupo'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'idgrupo')),
      'id_estudiante'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UsuarioCurso'), 'column' => 'id_usuario_curso')),
    ));

    $this->widgetSchema->setNameFormat('estudiantegrupo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiantegrupo';
  }

  public function getFields()
  {
    return array(
      'idestudiantegrupo' => 'Number',
      'idgrupo'           => 'ForeignKey',
      'id_estudiante'     => 'ForeignKey',
    );
  }
}
