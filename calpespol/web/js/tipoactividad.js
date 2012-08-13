/* 
 * @author Andrea Cáceres
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */

$(document).ready(function(){
    //Declaracion de variables
    var inputNombre = $("#nombre");       
    var reqNombre= $("#req-nombre");
    
    var inputTipoactividad = $("#tipo_actividad");       
    var reqTipoactividad= $("#req-tipoactividad");
    
    var inputPonderacion = $("#ponderacion");
    var reqPonderacion = $("#req-ponderacion");
    
    var inpuRealizacion = $("#tipo_realizacion");
    var reqRealizacion = $("#req-realizacion");
    
    var inputExtra = $("#extra");
    var reqExtra = $("#req-extra");
    
    var inputParcial = $("#parcial");
    var reqParcial = $("#req-parcial");
    
    /*Eventos asignados a los texfied y se ejecutan cuando pierden el foco
    entonces llaman a las respectivas funciones*/
    inputNombre.blur(function(){
        validarCaracteres(inputNombre,reqNombre);
    });
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputPonderacion.blur(function(){
        validarNumero(inputPonderacion,reqPonderacion);
    });
    
    /**
    * Valida 
    *   -   si el campo input no han ingresado nada (Campo requerido)
    *   -   Si los caracteres ingresados son diferentes de alguna letra del abcdario
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
    function validarCaracteres(input,output){  
        //NO cumple longitud minima  
        if(input.val().length == 0){
            output.text(" * Campo Requerido");// mensaje de error
            output.css("visibility", "visible"); 
            return false;  
        }  
        //SI longitud pero caracteres diferentes de A-z  
        else if(!input.val().match(/^[a-zA-Z\s]+$/i)){
            output.text(" * No se permiten caracteres diferentes de [a-zA-Z]");// mensaje de error
            output.css("visibility", "visible");
            return false;  
        }  
        // SI longitud, SI caracteres A-z  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
    }
     
    /**
    * Valida 
    *   -   si el campo input no han ingresado nada (Campo requerido)
    *   -   Si los caracteres ingresados no son digitos
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
   function validarNumero(input,output){
       //NO cumple longitud minima  
        if(input.val().length == 0){
            output.text(" * Campo Requerido");// mensaje de error
            output.css("visibility", "visible"); //hace visible el tag del mensaje
            return false;  
        }  
        //no digitos de 0-9
        else if(!input.val().match(/^[0-9]+$/)){
            output.text(" * Sólo dígitos [0-9]");// mensaje de error
            output.css("visibility", "visible");//hace visible el tag del mensaje
            return false;  
        }
        else if (parseInt(input.val())>100){
            output.text(" * Numero no valido, Nota mayor de 100");//mensaje de error
            output.css("visibility","visible");
            return false;
        }
        // SI longitud, SI digitos 0-9  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
   }
    
});