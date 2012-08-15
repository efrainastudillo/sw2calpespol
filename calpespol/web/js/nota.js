/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author  Jefferson Rubio
 * @date    14 de Agosto de 2012
 */

$(document).ready(function(){
    
   $("#tipo_seleccionado").change(function(){
       $("form#form_tipos").submit();
   });
});
