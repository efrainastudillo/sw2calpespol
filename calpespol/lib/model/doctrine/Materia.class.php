<?php

/**
 * Materia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Materia extends BaseMateria
{

    
    public static function existeMateria($codigo){
        $q = Doctrine_Query::create()
        ->select("*")
        ->from('Materia m')
        ->where("m.codigo_materia=?",$codigo)
        ->execute();
        
        if($q->count()==0){
            return false;
        }else{
            return true;
        }
    }
    public static function getMateriaByCodigo($codigo){
        $q = Doctrine_Query::create()
        ->select("*")
        ->from('Materia m')
        ->where("m.codigo_materia=?",$codigo)
        ->fetchOne();
        return $q;
    }
    
    public static function getMateriasDeUsuario($user_espol){
        $materias=Doctrine_Query::create()
        ->select("*")
        ->from('Materia m')
        ->innerJoin()
        ->where("m.codigo_materia=?",$user_espol)
        ->execute();
    }
}