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
        {   query:$("#materia_select option:selected").text()
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
});
