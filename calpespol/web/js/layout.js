/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author  EFrain Astudillo
 * @date    20 de Julio de 2012
 */

$(document).ready(function(){
    
   $("#materia_selecionada").change(function(){
       $("form#form_materias").submit();
   });
});