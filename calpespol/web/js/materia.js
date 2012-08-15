/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author Efrain Astudillo
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */
$(document).ready(function(){
    

                                            //el mensaje de error
    var inputNombres = $("#nombres");       //referencia del textfield a validar
    var reqNombres = $("#req-nombres");   //referencia a un tag del documento para mostrar
                                            //el mensaje de error
                                            //referencia del textfield a validar
    var inputCodigo = $("#codigo");           //referencia del textfield a validar
    var reqCodigo= $("#req-codigo");         //referencia a un tag del documento para mostrar
                                            //el mensaje de error
    
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputCodigo.blur(function(){
        validarAlfaNumerico(inputCodigo, reqCodigo);
    });

    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputNombres.blur(function(){
        validarNombresConUnEspacio(inputNombres,reqNombres);
    });

    
        //evento click
       $("div#grabar_materia").click(function(){
           if( validarNombresConUnEspacio(inputNombres,reqNombres) && validarAlfaNumerico(inputCodigo, reqCodigo)){
                $("form#form_materia").submit();
           }
    });
    
   
    /**
    * Valida 
    *   -   si el campo input no han ingresado nada (Campo requerido)
    *   -   Si los caracteres ingresados no son digitos
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
   function validarAlfaNumerico(input,output){
       //NO cumple longitud minima  
        if(input.val().length == 0){
            output.text(" * Campo Requerido");// mensaje de error
            output.css("visibility", "visible"); //hace visible el tag del mensaje
            return false;  
        }  
        //no digitos de 0-9
        else if(!input.val().match(/^\w+$/)){
            output.text(" * Sólo caracteres Alfanuméricos");// mensaje de error
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
        else if(!input.val().match(/^[a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ]+$/i)){
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
  
});
    
    function materiasRefreshFromList(){
        var selected = document.getElementById('materia_lista_tipo').options[document.getElementById('materia_lista_tipo').selectedIndex].text;
        if(selected=="Materia ESPOL"){
            document.getElementById('materia_inner_div').style.display="block";
            document.getElementById('materia_nombre').style.display="none";
            document.getElementById('materia_codigo').style.display="block";
            document.getElementById('materia_codigo').value="";
            document.getElementById('materia_nombre').value="";
            document.getElementById('materia_userEspol').value="";
            document.getElementById('materia_tipo').value="Codigo";
        }else if(selected == "Otra"){
            document.getElementById('materia_inner_div').style.display="block";
            document.getElementById('materia_nombre').style.display="block";
            document.getElementById('materia_codigo').style.display="none";
            document.getElementById('materia_codigo').value="";
            document.getElementById('materia_nombre').value="";
            document.getElementById('materia_userEspol').value="";
            document.getElementById('materia_tipo').value="Nombre";
        }else
            document.getElementById('materia_inner_div').style.display="none";
            document.getElementById('materia_codigo').value="";
            document.getElementById('materia_nombre').value="";
            document.getElementById('materia_userEspol').value="";
            document.getElementById('materia_tipo').value="";
    }

function soloNumerosSinEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Predefinir como valido
    var respuesta = true;
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 48 && charCode <= 57) && charCode!=8)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
 
    //Regresar la respuesta
    return respuesta;
}

function soloNumerosConEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Predefinir como valido
    var respuesta = true;
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 48 && charCode <= 57) && charCode!=8 && charCode!=32)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
 
    //Regresar la respuesta
    return respuesta;
}

function soloLetrasSinEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Predefinir como valido
    var respuesta = true;
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 65 && charCode <= 90) && !(charCode >= 97 && charCode <= 122) && charCode!=8)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
 
    //Regresar la respuesta
    return respuesta;
}

function soloLetrasConEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Predefinir como valido
    var respuesta = true;
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 65 && charCode <= 90) && !(charCode >= 97 && charCode <= 122) && charCode!=8 && charCode!=32)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
 
    //Regresar la respuesta
    return respuesta;
}

function soloAlfanumericoSinEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 65 && charCode <= 90) && !(charCode >= 97 && charCode <= 122) && !(charCode >= 48 && charCode <= 57) && charCode!=8)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        return false;
    }
 
    //Regresar la respuesta
    return true;
}

function soloAlfanumericoConEspacio(evt)
{
    //Validar la existencia del objeto event
    evt = (evt) ? evt : event;
 
    //Extraer el codigo del caracter de uno de los diferentes grupos de codigos
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
 
    //Predefinir como valido
    var respuesta = true;
 
    //Validar si el codigo corresponde a los NO aceptables
    if (!(charCode >= 65 && charCode <= 90) && !(charCode >= 97 && charCode <= 122) && !(charCode >= 48 && charCode <= 57) && charCode!=8 && charCode!=32)
    {
        //Asignar FALSE a la respuesta si es de los NO aceptables
        respuesta = false;
    }
 
    //Regresar la respuesta
    return respuesta;
}