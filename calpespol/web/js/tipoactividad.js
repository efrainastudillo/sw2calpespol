/* 
 * @author Andrea Cáceres
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */

$(document).ready(function(){
    //Declaracion de variables
    var inputTipoacti = $("#tipo_acti");       
    var reqTipoacti= $("#req-tipacti");
    
    var inputPond = $("#ponde");
    var reqPond = $("#req-pond");
    
    var inpureal = $("#tipo_reali");
    var reqreal = $("#req-selec1");
    
    var inputextra = $("#extra");
    var reqextra = $("#req-selec2");
    
    var inputparcial = $("#parcial");
    var reqparcial = $("#req-selec3");
    
    /*Eventos asignados a los texfied y se ejecutan cuando pierden el foco
    entonces llaman a las respectivas funciones*/
    inputTipoacti.blur(function(){
        validarCaracteres(inputTipoacti,reqTipoacti);
    });
    //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputPond.blur(function(){
        validarNumero(inputPond,reqPond);
    });
        //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inpureal.blur(function(){
        validarSeleccion(inpureal,reqreal);
    });
        //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputextra.blur(function(){
        validarSeleccion(inputextra,reqextra);
    });
        //evento asignado al texfied y se ejecuta cuando pierde el foco
    //llama a la respectiva funcion
    inputparcial.blur(function(){
        validarSeleccion(inputparcial,reqparcial);
    });
    
    //Funcion que ejecuta la accion guardar
    $("div#grabar_actividad").click(function(){       
        if(validarCaracteres(inputTipoacti,reqTipoacti)&&validarNumero(inputPond,reqPond)&&(validarSeleccion(inpureal,reqreal)&& (validarSeleccion(inputextra,reqextra)) && (validarSeleccion(inputparcial,reqparcial)) )){
            $("#formulario").submit();//en esta linea envia el formulario
        }
        else
            alert("Llene bien el formulario");
    });
      
   $("#materia_select").change(function(){
        jQuery.post('Actividad/prueba', 
        {query:$("#materia_select option:selected").text()
        }, function(xml){
            //$("#prueba").empty();
            addMaterias(xml);
        });
        //alert("Hola");
    });
    
   function addMaterias(xml){
       if($("status",xml).text() == "2") 
         return;
     
        $("materia",xml).each(function(id) {
              materia = $("materia",xml).get(id);
              $("#prueba").prepend("<b>"+$("author",materia).text()+
                             "</b>: "+$("text",message).text()+
                             "<br />");
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
        else if (input.val().length >3){
            output.text(" * Numero no valido, hay mas de tres digitos");//mensaje de error
            output.css("visibility","visible");
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
            return false;  
        }  
        // SI longitud, SI caracteres A-z  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
    }
    
    function validarSeleccion(input,output){
        if (input != undefined && input.value != "" ){
            output.text(" * Escoja una opcion");// mensaje de error
            output.css("visibility", "visible");
            return false;
        }
        else{
            output.css("visibility", "hidden");
            return true;
        }
    }
    
});
