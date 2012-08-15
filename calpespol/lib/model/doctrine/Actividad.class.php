<?php

/**
 * Actividad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Actividad extends BaseActividad
{
    public static function getActividades(){
        $a = Doctrine_Query::create()
        ->from('Actividad a');
        return $a->execute(); 
        
    }
    public function listaActividad(sfWebRequest $request){ 
        $this->actividad = Doctrine::getTable('Actividad')
                ->createQuery('select (nombre)')
                ->execute();
    }
    public static function getActividadesByUserEspol($user_espol){
        $a = Doctrine_Query::create()
        ->from('Actividad a');
        return $a->execute();
    }
    

}