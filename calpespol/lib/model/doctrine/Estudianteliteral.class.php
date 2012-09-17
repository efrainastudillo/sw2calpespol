<?php

/**
 * Estudianteliteral
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Estudianteliteral extends BaseEstudianteliteral
{
    
    public function grabarNota($estudiante, $literal, $calificacion, $calificador, $fecha){
         $nota = new Estudianteliteral();
         $nota ->setIdEstudiante($estudiante);
         $nota ->setIdliteral($literal);
         $nota ->setNotaLiteral($calificacion);
         $nota ->setIdCalificador($calificador);
         $nota ->setFecha($fecha);
         $nota ->setComentario("Ninguno");
         
         $nota -> save();
    }
    
    public static function getNotaXLiteralEstudiante($literal,$estudiante)
    {
        $q = Doctrine_Query::create()        
        ->from('Estudianteliteral el')
        ->where('el.idliteral=?',$literal) 
        ->andWhere('el.id_estudiante=?',$estudiante);
        return $q->execute();
    }
}