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
            if((!validarNumero($(this).val())) | ($(this).val() > parseInt($(this).next().val()))){
                alert("Ingrese un valor de nota válido por favor");
                $(this).css("background-color","red");
            }else{
                $(this).css("background-color","white");
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
     
   $("#guardar_notas").click(function(){
       alert($(".estudiante").size());
       
//       for(i=0; i<$(".nota_literal").size();i++){
//           for(j=0; j<($(".nota_literal").size()/$(".estudiante").size()); j++){
//               alert(i+","+j);
//           }
//       }
//           if(validarCaracteres(inputUsername,reqUsername) && validarEmail(inputEmail, reqEmail) && validarNumero(inputIdUser, reqIdUser)){
//                jQuery.post('process',
//                {id: inputIdUser.val(),
//                    nombre:inputUsername.val(),
//                    email: inputEmail.val()
//                }, function(xml){
//                    getMessage(xml);
//                });

    });
   
});
