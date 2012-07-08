/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
    
    var inputIdUser = $("#userID");  
    var mensaje = $("#mensaje_error"); 
    var contrasenia = $("#userPASS");   
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputIdUser.blur(function(){
        if(validarCaracteres(inputIdUser, mensaje)){
            $("#i1").css("visibility", "hidden");
        }else{
            $("#i1").css("visibility", "visible");
        };
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    contrasenia.blur(function(){
        if(validarRequerido(contrasenia,mensaje)){
            $("#i2").css("visibility", "hidden");
        }else{
             $("#i2").css("visibility", "visible");
        };
    });
    
        //evento click
       $("div.button").click(function(){
           if(validarRequerido(contrasenia,mensaje) && validarCaracteres(inputIdUser, mensaje)){
//                jQuery.post('process',
//                {id: inputIdUser.val(),
//                 pass:contrasenia.val()
//                }, function(xml){
//                    getMessage(xml);
//                });
               getMensaje("authentication", inputIdUser.val(), contrasenia.val())
                 


           }else{
           }
        //alert("Hola");
    });
    
    function getMensaje(sfAction, user,pass)
    {
          $.ajax(
          {
            url: sfAction,
            data: ({sfUserId: user,sfPass: pass}),
            dataType: "json",
            beforeSend: function()
            {             
              $("#mensaje_error").text('Cargando Datos...');
               $("#mensaje_error").css("visibility", "visible");
            },
            complete: function()
            {
              //$("#mensaje_error").
            },
            success: function (data, status)
            {
                $("#mensaje_error").text(data.error);
                window.location.href = 'http://localhost/sw2calpespol/calpespol/web/frontend_dev.php/Inicio/index';

//              $("#propuesta_nombre_contratante").val(data.error);
//              $("#propuesta_apellido_p_contratante").val(data.apellidoP);
//              $("#propuesta_apellido_m_contratante").val(data.apellidoM);
              /* ... etc */
            },
            error: function (data, status, e)
            {
                alert('Ocurrió un error cargando los datos solicitados:.\n'+data.error);
            }
        });
    }

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
    
    function validarRequerido(input,output){  
        //NO hay nada escrito  
        if(input.val().length == 0){  
            output.text(" * Campo Requerido");  
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