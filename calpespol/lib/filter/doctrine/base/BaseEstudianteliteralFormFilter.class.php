<?php

/**
 * Estudianteliteral filter form base class.
 *
 * @package    CALPESPOL
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteliteralFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nota_literal'   => new sfWidgetFormFilterInput(),
      'id_calificador' => new sfWidgetFormFilterInput(),
      'fecha'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'comentario'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nota_literal'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_calificador' => new sfValidatorPass(array('required' => false)),
      'fecha'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'comentario'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudianteliteral_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudianteliteral';
  }

  public function getFields()
  {
    return array(
      'id_estudiante'  => 'Number',
      'idliteral'      => 'Number',
      'nota_literal'   => 'Number',
      'id_calificador' => 'Text',
      'fecha'          => 'Date',
      'comentario'     => 'Text',
    );
  }
}
