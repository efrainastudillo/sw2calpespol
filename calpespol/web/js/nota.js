/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author  Jefferson Rubio
 * @date    14 de Agosto de 2012
 */

$(document).ready(function(){
    
//   var inputNota = $("#idUsuario");      //referencia del textfield a validar 
    
   $("#tipo_seleccionado").change(function(){
       $("form#form_tipos").submit();
   });
   
   $("#actividad_seleccionada").change(function(){
       $("form#form_actividad").submit();
   });
   
   $(".nota_literal").on(
   
        "blur", function() {
            if(!validarNumero($(this).val())){
                alert("chao");
                $(this).css("background-color","red");
            }

        }
   );
   
   function validarNumero(input){
       //NO cumple longitud minima  
        if(input.length == 0){
            return false;  
        }  
//        //no digitos de 0-9
        else if(!input.match(/^[0-9]+$/)){ 
            return false;  
        }  
//        // SI longitud, SI digitos 0-9  hace oculto el tag que muestra el mensaje
        else{  
            return true;  
        }  
   }
      
});
