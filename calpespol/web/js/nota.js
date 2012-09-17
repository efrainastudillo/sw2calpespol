/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author  Jefferson Rubio
 * @date    14 de Agosto de 2012
 */

$(document).ready(function(){
    
   var error = 0;
    
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
   
   $("#guardar_notas").click(function(){
      
      var arregloNotas = new Array();
      var arregloUsuarios = new Array();
      var arregloLiterales = new Array();
      
      var i=0;
      
      $('.nota_literal').each(function(i) {
        arregloNotas[i] = $(this).val();
        arregloLiterales[i] = $(this).attr('id');
//        alert(arregloNotas[i]);
//parseInt($(this).next().val()) < $(this).val() ||
        if( parseInt($(this).next().val()) < $(this).val() || $(this).val() < 0){
            error++;
//            alert($(this).next().val()+": "+$(this).val()+": "+error);
        }else{
            error;
        }
      });
      
      $('.name_user').each(function(j) {
        arregloUsuarios[j] = $(this).val();
      });
      
      if (error==0){
        $.ajax({
            url: "GuardarNota",
            type: "GET",
            data: {notas: arregloNotas,
                usuarios: arregloUsuarios,
                literales: arregloLiterales},
            async: true
        }); 
//        error = 0;
      }else{
          alert("No ha ingresado valores o estan incorrectos. Revise por favor!!");
          
      }
        
      

   });
   
   function validarNumero(input){
       //NO cumple longitud minima  
        if(input.length == 0){
            return false;  
        }  
//        //no digitos menores que 0
        else if(input<0){ 
            return false;  
        }  
//        hace oculto el tag que muestra el mensaje
        else{  
            return true;  
        }  
   } 
   
});
