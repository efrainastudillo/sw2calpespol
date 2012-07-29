<?php

/**
 * Literal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    CALPESPOL
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Literal extends BaseLiteral
{
//    public static function getLiterales()
//    {
//        $q = Doctrine_Query::create()
//        ->from('Literal l');
//        return $q->execute();
//    }
    
    
    public static function getLiterales()
    {
        $q = Doctrine_Query::create()
        ->select('*')   
        ->from('literal l')
        ->where('l.id_actividad=?', '2');
        return $q->execute();  
    }
    
    public static function getLiteralesXActividad($idActivity)
    {
        $q = Doctrine_Query::create()  
        ->select('l.id_actividad')        
        ->from('Literal l')
        ->innerjoin('l.Actividad a ON l.id_actividad = a.idactividad')
        ->where('a.idactividad=?',$idActivity);      
        return $q->execute();
    }
    
    public function grabarLiteral(sfWebRequest $request){
         $literal_actividad = new Literal();
         $literal_actividad ->setNombreLiteral($request->getParameter("detalle"));
         $literal_actividad ->setValorPonderacion($request->getParameter("puntos"));
         $literal_actividad ->setIdActividad($request->getParameter("actividad"));
         $literal_actividad -> save();
    }
}