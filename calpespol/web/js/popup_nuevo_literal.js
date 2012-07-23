/* 
    Document   : rubrica
    Created on : 2012
    Author     : JPopup
    Modified by: Jefferson Rubio
    Reference  : http://www.jquerypopup.com
    Description:
        Archivo jquery que incorpora las funcionalidades de popup, ajax y estilo
        para dar una buena presentación al sistema.
*/

$(document).ready(function() {

            //Change these values to style your modal popup
            var align = 'center';									//Valid values; left, right, center
            var top = 250; 											//Use an integer (in pixels)
            var width = 500; 
            var padding = 10;										//Use an integer (in pixels)
            var backgroundColor = '#ececc6'; 						//Use any hex code
            var source = 'Actividad/newLiteral'; 								//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
            var borderColor = '#333'; 							//Use any hex code
            var borderWeight = 5; 									//Use an integer (in pixels)
            var borderRadius = 2; 									//Use an integer (in pixels)
            var fadeOutTime = 100; 									//Use any integer, 0 = no fade
            var disableColor = '#666'; 							//Use any hex code
            var disableOpacity = 40; 								//Valid range 0-100
            var loadingImage = '';		//Use relative path from this page

            //This method initialises the modal popup
    
    $("#nuevo_literal").click(function() {
        modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
    });

    //This method hides the popup when the escape key is pressed
    $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                    closePopup(fadeOutTime);
            }
    });
    
    /**
    * Valida 
    *   -   si el campo input no han ingresado nada (Campo requerido)
    *   -   Si los caracteres ingresados no son digitos
    *   @param input referencia del texfield
    *   @param output referencia al span en donde se agregara el texto de error a mostrar
    */
   function validarNumero(input,output){
       //NO cumple longitud minima  
        if(input.val().length == 0){
            output.text(" * Campo Requerido");// mensaje de error
            output.css("visibility", "visible"); //hace visible el tag del mensaje
            return false;  
        }  
        //no digitos de 0-9
        else if(!input.val().match(/^[0-9]+$/)){
            output.text(" * Sólo dígitos [0-9]");// mensaje de error
            output.css("visibility", "visible");//hace visible el tag del mensaje
//            inputUsername.addClass("error");  
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
//            inputUsername.addClass("error");  
            return false;  
        }  
        // SI longitud, SI caracteres A-z  hace oculto el tag que muestra el mensaje
        else{  
           output.css("visibility", "hidden");
            return true;  
        }  
    }
    
});



