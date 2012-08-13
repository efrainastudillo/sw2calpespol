/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (){
    $("#fecha").datepicker();
    
    var inputDescrip = $("#descripcion");       
    var reqDescript= $("#req-descripcion");
    
    var inputGrade = $("#nota");
    var reqGrade = $("#req-nota");
    
    /*Eventos asignados a los texfied y se ejecutan cuando pierden el foco
    entonces llaman a las respectivas funciones*/
    inputDescrip.blur(function(){
        validarCaracteres(inputDescrip,reqDescript);
    });
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputGrade.blur(function(){
        validarNumero(inputGrade,reqGrade);
    });
    
    $("div#grabar_actividad").click(function(){
        if(validarNumero(inputGrade,reqGrade)&&validarCaracteres(inputDescrip,reqDescript)){
            $("#form_new_actividad").submit();//en esta linea envia el formulario
            //alert("Holas")
        }
        else{
             //alert("Llene bien el formulario");
        }           
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
        else if(!input.val().match(/^[a-zA-Z\s]|[a-zA-Z\s]+\s[a-zA-Z\s]+$/i)){
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
