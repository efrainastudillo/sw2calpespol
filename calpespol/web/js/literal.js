/* 
<<<<<<< HEAD
 * @author Jefferson Rubio 
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */

//$(document).ready(function(){
//    //Declaracion de variables
//
//   $('#div_linea_bajo_menu').click(function(){
//       alert("hola");
//   });

$(document).ready(function(){
    
    var inputDescripcion = $("#descripcion");      //referencia del textfield a validar
    var reqDescripcion = $("#req-Descrip");       //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    var inputPuntaje = $("#puntaje");       //referencia del textfield a validar
    var reqPuntaje = $("#req-Punto");   //referencia a un tag del documento para mostrar
                                            //el mensaje de error
   
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputPuntaje.blur(function(){        
        validarNumero(inputPuntaje, reqPuntaje);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputDescripcion.blur(function(){
        validarCaracteres(inputDescripcion,reqDescripcion);
    });
    
    
    $("#save").click(function(){
        alert("HOLAS");
    });


   
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
//            inputUsername.addClass("error");  
            return false;  
        }  
        // SI longitud, SI digitos 0-9  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
   }
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
        else if(!input.val().match(/^[a-z A-Z]+$/)){
            output.text(" * No se permiten caracteres diferentes de [a-zA-Z]");// mensaje de error
            output.css("visibility", "visible");
//            inputUsername.addClass("error");  
            return false;  
        }  
        // SI longitud, SI caracteres A-z  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
    }

});
