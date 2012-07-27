/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @author Efrain Astudillo
 * @fecha  27 de Julio de 2012
 */


$(document).ready(function(){
    $("#fecha").datepicker({
        
        onSelect: function(dateText,inst){
            //alert(dateText);
            $("#formulario_fecha").submit();
        },
        dateFormat: "yy-mm-dd",
        altFormat: "yy-mm-dd",
        buttonImage: "../images/back.png"
    });
});