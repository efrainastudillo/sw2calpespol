/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @author Andrea Cáceres
 * Descripción: Valida el texto ingresado de los input de tipo text dependiendo 
 * de la funcion que se le asigne
 */
$(document).ready(function(){
    //Declaracion de variables
    var inputNota = $("#grade");       
    var reqNota= $("#req-nota");
    
    var inputDescrip = $("#descrip");
    var reqDescrip = $("#req-descripcion");
    
    var inputDate = $("#date");
    var reqDate = $("#req-fecha");
    
//Funcion que ejecuta la accion guardar
    $("div#grabar_actividad").click(function(){
        if((validarNumero(inputNota,reqNota)) && (validarCaracteres(inputDescrip,reqDescrip)) == true){
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
        //no digitos de 0-9
        if(!input.val().match(/^[0-9]+$/)){
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
    
           /**
    * Valida 
    *   -   si el campo input no han ingresado nada (Campo requerido)
    *   -   Si los caracteres ingresados son diferentes de alguna letra del abcdario
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
    function validarFecha(input,output){  
       
    }
    
   function FechaActual(){
        var f = new Date();
        return (f.getDate() + "/" + (f.getMonth()+1) + "/" + f.getFullYear());
   }
   
   /*                        Sección Literales                            */
   
    /*
     * Método que muestra los literales de una actividad
     */
    $(".flecha_literal").on("click", function() {
        //Div tabla_literal que tiene la tabla con el id de la actividad clickeada
        var tabla_literal = $("."+$(this).attr("id")).parent().parent();
        
        $(".tabla_literal").css("visibility","hidden");
        $(".tabla_literal").css("display","none");
        //Diseño: pregunta si el estado de la flecha indicadora para que 
        //retroalimente al usuario que literales de que actividad se estan viendo.
        if($(this).attr("src")=="../images/arrow-right-3.png"){
            $(".flecha_literal").attr("src","../images/arrow-right-3.png");
            $(this).attr("src","../images/arrow-down-3.png");
            tabla_literal.css("visibility","visible");
            tabla_literal.css("display","block");
        }else{
            $(this).attr("src","../images/arrow-right-3.png");
            $(".tabla_literal").slideUp();
        }  
    });
});
