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
    
    public static function getLiteralesXTipoActividadMateria($type,$nameActivity, $nameSubject)
    {
        $q = Doctrine_Query::create()  
        ->select('l.id_actividad')        
        ->from('Literal l')
        ->innerjoin('l.Actividad a ON l.id_actividad = a.idactividad')
        ->innerjoin('a.Tipoactividad ta ON a.id_tipo_actividad = ta.idtipoactividad')
        ->innerjoin('ta.Curso c ON ta.id_curso = c.idcurso')
        ->innerjoin('c.UsuarioCurso uc ON c.idcurso = uc.id_curso')
        ->innerJoin('c.Materia m ON c.id_materia=m.idmateria')
        ->where('a.nombre=?',$nameActivity) 
        ->andWhere('a.id_tipo_actividad=?',$type)
        ->andWhere('m.nombre=?',$nameSubject);
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
    
    public function grabarLiteral($request){
         $literal_actividad = new Literal();
         $literal_actividad ->setNombreLiteral($request->getParameter("detalle"));
         $literal_actividad ->setValorPonderacion($request->getParameter("puntos"));
         $literal_actividad ->setIdActividad($request->getParameter("actividad"));
         $literal_actividad -> save();
    }
}