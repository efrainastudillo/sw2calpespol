/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
//    $("#botonPrueba").click(function(){
//        jQuery.post('Actividad/prueba', 
//        {   user: "AMARANTO",
//            password: "secret"
//        }, function(xml){
//            //$("#prueba").empty();
//            addMessages(xml);
//        });
//        //alert("Hola");
//    });
//    
//    function addMessages(xml) {
//     if($("status",xml).text() == "2") 
//         return;
//     
//     timestamp = $("time",xml).text();
//        $("message",xml).each(function(id) {
//      message = $("message",xml).get(id);
//       $("#prueba").prepend("<b>"+$("author",message).text()+
//                     "</b>: "+$("text",message).text()+
//                     "<br />");
//     });
//   }

//Esto es JQuery  aqui cojo el tag que div y que contiene el id grabar_actividad eso tb  falleta ba?
//aa?/es tb faltaba de implementar para q grabe? claro porque el boton esta hecho en css y no sabe que hacer por loque tu debes
//hacer el submit 
    $("div#grabar_actividad").click(function(){
        //alert("funciona");
        $("#formulario").submit();//en esta linea envia el formulario 
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
        if($(this).attr("src")=="../images/arrow-right-3.png"){
            $(".flecha_literal").attr("src","../images/arrow-right-3.png");
            $(this).attr("src","../images/arrow-down-3.png");
            tabla_literal.css("visibility","visible");
            tabla_literal.css("display","block");
        }else{
            $(this).attr("src","../images/arrow-right-3.png");
            $(".tablescroll_body").find("td").css("background-color","#EDEDCB");
        }  
    });
});
