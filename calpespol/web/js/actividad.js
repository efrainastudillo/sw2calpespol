/* 
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
    
    var inputipoacti = $("#tipo_acti");
    var reqtipoacti = $("#option");
    //Elimina el scrollbar del template
    $("#div_contenedor_template").css("overflow","hidden");
    
    /*Eventos asignados a los texfied y se ejecutan cuando pierden el foco
    entonces llaman a las respectivas funciones*/
    inputNota.blur(function(){
        validarNumero(inputNota, reqNota);
    });

    inputDescrip.blur(function(){
        validarCaracteres(inputDescrip,reqDescrip);
    });

    inputipoacti.blur(function(){
        validarSeleccion(inputipoacti,reqtipoacti);
    });
    
    
    //Funcion que ejecuta la accion guardar
    $("div#grabar_actividad").click(function(){
        if((validarCaracteres(inputDescrip,reqDescrip) && validarNumero(inputNota,reqNota) && (validarSeleccion(inputipoacti,reqtipoacti))) == true){
            $("#formulario").submit();//en esta linea envia el formulario
            alert("Actividad Registrada");
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
    *  validarNumero(input,output) script que valida entradas de un formulario
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
    *  validarCaracteres(input,output) script que valida entradas de un formulario
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
    *  validarSeleccion(input,output) script que valida entradas de un formulario
    */
    function validarSeleccion(input,output){
        if (input.value == "" ){
            output.text(" * Escoja una opcion");// mensaje de error
            output.css("visibility", "visible");
            return false;
        }
        else{
            output.css("visibility", "hidden");
            return true;
        }
    }
    
   
   /*                        Sección Literales                            */
   
    /*
     * Método que muestra los literales de una actividad
     */
    $(".flecha_literal").on("click", function() {
        
        $(".tablescroll_body").find("td").css("background-color","#EDEDCB");
        //Cambia el color del tr de la actividad escogida, para reconocer a que actividad 
        //pertenecen los literales mostrados.
        $(this).parent().css("background-color","#D3E2C2");
        $(this).parent().nextAll().css("background-color","#D3E2C2");
        //Div tabla_literal que tiene la tabla con el id de la actividad clickeada.
        var tabla_literal = $("."+$(this).attr("id")).parent().parent();
        //Escondo todos los literales que no pertecen a la actividad escogida.
        $(".tabla_literal").css("display","none");
        //Diseño: pregunta si el estado de la flecha indicadora para que 
        //retroalimente al usuario que literales de que actividad se estan viendo.
        if($(this).attr("src")=="/sw2calpespol/calpespol/web/images/arrow-right-3.png"){
            $(".flecha_literal").attr("src","/sw2calpespol/calpespol/web/images/arrow-right-3.png");
            $(this).attr("src","/sw2calpespol/calpespol/web/images/arrow-down-3.png");
            tabla_literal.css("visibility","visible");
            tabla_literal.css("display","block");
        }else{
            $(this).attr("src","/sw2calpespol/calpespol/web/images/arrow-right-3.png");
            $(".tablescroll_body").find("td").css("background-color","#EDEDCB");
        }  
    });
});


//    function validarFecha(input,output){
//        var actual = new Date();
//        var dia = actual.getDate();
//        var mes = actual.getMonth()+1;
//        var anio = actual.getFullYear();
//      
//        var dia1  =  parseInt(input.value.substring(0,2));
//        var mes1  =  parseInt(input.value.substring(3,5));
//        var anio1 =  parseInt(input.value.substring(6,10));
//        
//        if (input != undefined && input.value != "" ){
//            output.text(" * Escoja un fecha");// mensaje de error
//            output.css("visibility", "visible");
//            return false;
//        }
//        else if (dia1 != dia){
//            output.text(" * Dia erroneo");// mensaje de error
//            output.css("visibility", "visible");
//            return false;
//        }
//        else if (mes1 != mes){
//            output.text(" * Mes erroneo");// mensaje de error
//            output.css("visibility", "visible");
//            return false;
//        }
//        else if (anio1 != anio){
//            output.text(" * Anio erroneo");// mensaje de error
//            output.css("visibility", "visible");
//            return false;
//        }
//    
//        else{   
//            output.css("visibility", "hidden");
//            return true;
//        }
//    }