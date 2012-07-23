<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * 
 * Clase Utility
 * @name Utility 
 * @author Efrain Astudillo
 */

/**
 * 
 * @example
 * Ejemplos de uso para comparar los rangos de las fechas 
 *    $primera=date("d/m/Y");//obtengo la fecha actual      
      $segunda="18/07/2012";//rango menor
      $tercera="14/09/2012";//rango mayor
        $result=Utility::fechaEstaEnRango($primera, $segunda, $tercera);//comparo
        if($result){
            $this->variable="Esta en el rango";
        }  
        else if(!$result){
             $this->variable="NO Esta en el rango";
        }
        else{
            $this->variable="ERROR";
        }
 */
 class Utility{
     
     
     /**
      * Si fecha $primera es mayor que la $segunda devolvera positivo y 
      * si es menor un valor negativo y si son iguales devolvera 0
      * Las fechas deben ser diferentes para que funcione
      * La fecha debe estar en el siguiente formato 
      * date("d/m/Y")
      * "01-31/01-12/2012"
      * @example "15/07/2012"
      * @return type  String cuando existe un error
      *               Int cuando esta todo correcto
      *               
      */
     public static function comparaFechas($primera,$segunda){
         $valoresPrimera = explode ("/", $primera);   
          $valoresSegunda = explode ("/", $segunda); 

          $diaPrimera    = $valoresPrimera[0];  
          $mesPrimera  = $valoresPrimera[1];  
          $anyoPrimera   = $valoresPrimera[2]; 

          $diaSegunda   = $valoresSegunda[0];  
          $mesSegunda = $valoresSegunda[1];  
          $anyoSegunda  = $valoresSegunda[2];

          $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
          $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

          if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
            // "La fecha ".$primera." no es v&aacute;lida";
            return "ERROR";
          }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
            // "La fecha ".$segunda." no es v&aacute;lida";
            return "ERROR";
          }else{
            return  $diasPrimeraJuliano - $diasSegundaJuliano;
          } 
     } //fin de comparaFechas
     
     /**
      * Funcion que verifica si una fecha se encuentra en un rango de fechas que 
      * se envian com argumentos 
      * El formateo de las fechas es importante para que funcione correctamente
      * @example date(d/m/Y)     "02/07/2012"
      * @param type $fechaComparar      fecha que se quiere ver si se encuentra 
      *                                 en algun rango
      * @param type $fechaRangoMenor    rango menor
      * @param type $fechaRangoMayor    rango mayor
      * @return type mensaje String si hay error el formateado de las fechas
      *              true si se encuentra en el rango de otra forma false
      */
     public static function fechaEstaEnRango($fechaComparar,$fechaRangoMenor,$fechaRangoMayor){
         $r1=  Utility::comparaFechas($fechaComparar, $fechaRangoMenor);
         $r2=  Utility::comparaFechas($fechaComparar, $fechaRangoMayor);
         if($r1=="error" || $r2=="error")
             return "ERROR EN LA FORMATEADA DE LAS FECHAS";
         if($r1>=0 && $r2<=0){
             return true;
         }
         else {
             return false;
         }
     }//fin de fechaEstaen Rango
     
     /**
      *
      * @param type $codigo_materia
      * @return type 
      */
     public static function getMateria($codigo_materia){
         $materia=Doctrine_Query::create()
                 ->select("*")
                 ->from("Materia m")
                 ->where("m.codigo_materia=?",$codigo_materia)
                 ->execute();
         //Si El Usuario no esta registrado en ninguna de las materias que 
         //se encuentra en el sistema
//         if(intval($materias[0])==0){
//             return false;
//         }else{
//            return true;
//         }
        return $materia;
     }
     
     /**
      * Obtengo el Anio que representa el presente Termino.
      * Internamente coge la fecha actual del Sistema y valida para retornar el anio.
      * @return String  Anio de tipo String
      */
     public static function getAnio(){
         $fecha_actual=date("d/m/Y");
         $anio=date("Y");

         //SEGUNDA PARTE
         $primera_2_2="01/01/".$anio;
         $segunda_2_2="27/02/".$anio;
         //para calcular el tercer termino
         $primera_3="05/03/".$anio;
         $segunda_3="05/05/".$anio;
         
         if(Utility::fechaEstaEnRango($fecha_actual, $primera_2_2, $segunda_2_2)
                 || Utility::fechaEstaEnRango($fecha_actual, $primera_3, $segunda_3)){
             return $anio - 1;
         }
         else{
             return $anio;
         }
     }
     
     /**
      * Obtiene el Termino actual de acuerdo a la fecha actual del Sistema y los 
      * rangos de Fechas a las que consta cada Semestre en la Espol.
      * @return Integer 
      */
     public static function getTermino(){
         $fecha_actual=date("d/m/Y");
         $anio=date("Y");
         //para calcular el primer termino
         $primera_1="01/05/".$anio;
         $segunda_1="22/09/".$anio;
         //para calcular el segundo termino PRIMERA PARTE
         $primera_2_1="01/10/".$anio;
         $segunda_2_1="31/12/".$anio;
         //SEGUNDA PARTE
         $primera_2_2="01/01/".$anio;
         $segunda_2_2="27/02/".$anio;
         //para calcular el tercer termino
         $primera_3="05/03/".$anio;
         $segunda_3="05/05/".$anio;
         
         if(Utility::fechaEstaEnRango($fecha_actual, $primera_1, $segunda_1)){
             return 1;
         } elseif (Utility::fechaEstaEnRango($fecha_actual, $primera_2_1, $segunda_2_1) 
                 || Utility::fechaEstaEnRango($fecha_actual, $primera_2_2, $segunda_2_2)) {             
            return 2;
         }elseif(Utility::fechaEstaEnRango($fecha_actual, $primera_3, $segunda_3)){
             return 3;
         }else{
             return -1;
         }
     }
     /**
      * Obtiene el parcial dado el termino 
      * @param Integer $termino dado el termino que parcial le corresponde
      */
     public static function getParcial($termino){
         if($termino==1){
             
         }elseif($termino==2){
             
         }  elseif ($termino==3) {
             
         }
     }
     /**
      * 
      * @param String $user_espol Nombre de Usuario de Espol
      * @return Array de Tipo de Usuarios 
      */
     public static function getUsuario($user_espol){
         $user=Doctrine_Query::create()
                 ->select("*")
                 ->from("Usuario u")
                 ->where("u.usuario_espol=?",$user_espol)
                 ->execute();
         return $user;
     }
   
 
 }//fin de la clase Utility
?>

