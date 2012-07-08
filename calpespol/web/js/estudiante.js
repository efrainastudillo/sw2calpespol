/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    var inputIdUser = $("#idUsuario");  
    var reqIdUser = $("#req-iduser"); 
    var inputUsername = $("#nombre");  
    var reqUsername = $("#req-username");  
    var inputEmail = $("#email");  
    var reqEmail = $("#req-email");  
    
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
            output.text(" * Campo Requerido");
            output.css("visibility", "visible"); 
            return false;  
        }  
        //no digitos de 0-9
        else if(!input.val().match(/^[0-9]+$/)){
            output.text(" * Sólo dígitos [0-9]");
            output.css("visibility", "visible");
//            inputUsername.addClass("error");  
            return false;  
        }  
        // SI longitud, SI digitos 0-9  
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
            output.text(" * Campo Requerido");
            output.css("visibility", "visible"); 
            return false;  
        }  
        //SI longitud pero caracteres diferentes de A-z  
        else if(!input.val().match(/^[a-zA-Z]+$/)){
            output.text(" * No se permiten caracteres diferentes de [a-zA-Z]");
            output.css("visibility", "visible");
//            inputUsername.addClass("error");  
            return false;  
        }  
        // SI longitud, SI caracteres A-z  
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
            output.text(" * Campo Requerido");  
            output.css("visibility", "visible");  
            return false;  
        }  
        // SI escrito, NO VALIDO email  
        else if(!input.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i)){  
            output.text(" * Correo No Válido");  
            output.css("visibility", "visible");  
            return false;  
        }  
        // SI rellenado, SI email valido  
        else{  
            output.css("visibility", "hidden");
            return true;  
        }  
    }  
});