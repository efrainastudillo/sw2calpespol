<?php

/**
 * Usuario form.
 *
 * @package    CALPESPOL
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'idusuario'     => new sfWidgetFormInputHidden(),
      'usuario_espol' => new sfWidgetFormInputText(array(),array('name'=>'userespol','placeholder'=>'Usuario Espol')),
      'nombre'        => new sfWidgetFormInputText(array(),array('name'=>'nombre','placeholder'=>'Nombres')),
      'apellido'      => new sfWidgetFormInputText(array(),array('name'=>'apellido','placeholder'=>'Apellidos')),
      'mail'          => new sfWidgetFormInputText(array(),array('name'=>'mail','placeholder'=>'Mail')),
      'matricula'     => new sfWidgetFormInputText(array(),array('name'=>'matricula','placeholder'=>'Matricula')),
      'cedula'        => new sfWidgetFormInputText(array(),array('name'=>'cedula','placeholder'=>'Cedula')),
    ));
      
      $this->setValidators(array(
      'idusuario'     => new sfValidatorPass(),
      'usuario_espol' => new sfValidatorString(array('max_length' => 45)),
      'nombre'        => new sfValidatorString(array('max_length' => 45)),
      'apellido'      => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'mail'          => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'matricula'     => new sfValidatorString(array('max_length' => 45, 'required' => true)),
      'cedula'        => new sfValidatorString(array('max_length' => 10, 'required' => true)),
    ));
      
      $this->validatorSchema->setOption('allow_extra_fields', true);
      $this->validatorSchema->setOption('filter_extra_fields', false);
  }
}
