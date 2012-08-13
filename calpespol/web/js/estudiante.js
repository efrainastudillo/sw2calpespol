/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author Efrain Astudillo
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */
$(document).ready(function(){
    
    var inputIdUser = $("#idUsuario");      //referencia del textfield a validar
    var reqIdUser = $("#req-iduser");       //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    var inputUsername = $("#nombre");       //referencia del textfield a validar
    var reqUsername = $("#req-username");   //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    var inputEmail = $("#email");           //referencia del textfield a validar
    var reqEmail = $("#req-email");         //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputIdUser.blur(function(){
        validarNumero(inputIdUser, reqIdUser);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputUsername.blur(function(){
        validarCaracteres(inputUsername,reqUsername);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputEmail.blur(function(){
        validarEmail(inputEmail, reqEmail);
    });
    
    $("div#update_user").click(function(){
        
    });
        //evento click
       $("#grabarEstudiante").click(function(){
           if(validarCaracteres(inputUsername,reqUsername) && validarEmail(inputEmail, reqEmail) && validarNumero(inputIdUser, reqIdUser)){
                jQuery.post('process',
                {id: inputIdUser.val(),
                    nombre:inputUsername.val(),
                    email: inputEmail.val()
                }, function(xml){
                    getMessage(xml);
                });
           }else{
//               validateEmail();
//               validateUsername();
           }
        //alert("Hola");
    });
    
    /**
     *  getMessage() obtiene el xml generado por el servidor que es un mensaje
     *  formateado por el usuario si esta todo bien
     */
   function getMessage(xml){
       if($("status",xml).text() == "2") 
         return;
     
        $("mensaje",xml).each(function(id) {
              mensaje = $("mensaje",xml).get(id);
              $("#flash_notice").text($("valor",mensaje).text());
     });
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
        else if(!input.val().match(/^[a-zA-Z]+$/)){
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
    
    /**
     * Valida
     *  -   Si el usario ha ingresado algun dato (Campo requerido)
     *  -   Si los datos ingresados como correo no cumple con el formato de correo user@dominio.com
     *  @param input referencia del texfield
     *  @param output referencia al span en donde se agregara el texto de error a mostrar
     */
    function validarEmail(input,output){  
        //NO hay nada escrito  
        if(input.val().length == 0){  
            output.text(" * Campo Requerido");  // mensaje de error
            output.css("visibility", "visible");  // hace visible el mensaje de error
            return false;  
        }  
        // SI escrito, NO VALIDO email  
        else if(!input.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i)){  
            output.text(" * Correo No Válido");  
            output.css("visibility", "visible");  
            return false;  
        }  
        // SI rellenado, SI email valido hace oculto el tag que muestra el mensaje
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
    function validarCaracteresConEspacio(input,output){  
        //NO cumple longitud minima  
        if(input.val().length == 0){
            output.text(" * Campo Requerido");// mensaje de error
            output.css("visibility", "visible"); 
            return false;  
        }  
        //SI longitud pero caracteres diferentes de A-z  
        else if(!input.val().match(/^[a-zA-ZñÑ\s]+$/)){
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