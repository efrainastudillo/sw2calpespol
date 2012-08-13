/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author Efrain Astudillo
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */
$(document).ready(function(){
    
    var inputUserEspol = $("#user_espol");      //referencia del textfield a validar
    var reqUserEspol = $("#req-user_espol");       //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    var inputNombres = $("#nombres");       //referencia del textfield a validar
    var reqNombres = $("#req-nombres");   //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    var inputApellidos = $("#apellidos");       
    var reqApellido= $("#req-apellidos");
    
    var inputCedula = $("#cedula");       
    var reqCedula= $("#req-cedula");
    
    var inputMatricula = $("#matricula");       
    var reqMatricula= $("#req-matricula");
                                            //referencia del textfield a validar
    var inputCorreo = $("#correo");           //referencia del textfield a validar
    var reqCorreo = $("#req-correo");         //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputCedula.blur(function(){
        validarCedula(inputCedula, reqCedula);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputMatricula.blur(function(){
        validarMatricula(inputMatricula, reqMatricula);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputNombres.blur(function(){
        validarNombresConUnEspacio(inputNombres,reqNombres);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputApellidos.blur(function(){
        validarNombresConUnEspacio(inputApellidos,reqApellido);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputUserEspol.blur(function(){
        validarCaracteres(inputUserEspol,reqUserEspol);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputCorreo.blur(function(){
        validarEmail(inputCorreo, reqCorreo);
    });
    
        //evento click
       $("div#update_user").click(function(){
           if(validarCedula(inputCedula, reqCedula) && validarMatricula(inputMatricula, reqMatricula) && validarNombresConUnEspacio(inputNombres,reqNombres)
                && validarCaracteres(inputUserEspol,reqUserEspol) && validarEmail(inputCorreo, reqCorreo) && validarNombresConUnEspacio(inputApellidos,reqApellido)){
                $("form#form_edit_estudiante").submit();
           }
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
     *  -   Si el usario ha ingresado algun dato (Campo requerido)
     *  -   Si los datos ingresados deben contener solo caracteres [a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ]
     *  @param input referencia del texfield
     *  @param output referencia al span en donde se agregara el texto de error a mostrar
     */
    function validarNombresConUnEspacio(input,output){  
        //NO hay nada escrito  
        if(input.val().length == 0){  
            output.text(" * Campo Requerido");  // mensaje de error
            output.css("visibility", "visible");  // hace visible el mensaje de error
            return false;  
        }  
        // SI escrito, NO VALIDO email  
        else if(!input.val().match(/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]+$/i)){
            output.text(" * Campo No Válido");  
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
    *   -   Si los caracteres ingresados no son digitos
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
   function validarCedula(input,output){
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
        
        else if(input.val().length != 10){
            output.text(" * Cédula debe tener 10 dígitos");// mensaje de error
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
    *   -   Si los caracteres ingresados no son digitos
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
   function validarMatricula(input,output){
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
        
        else if(input.val().length != 9){
            output.text(" * Matrícula debe tener 9 dígitos");// mensaje de error
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
});