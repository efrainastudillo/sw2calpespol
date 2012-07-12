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
            var top = 400; 											//Use an integer (in pixels)
            var width = 500; 
            var padding = 10;										//Use an integer (in pixels)
            var backgroundColor = '#ececc6'; 						//Use any hex code
            var source = 'rubrica/newRubrica'; 								//Refer to any page on your server, external pages are not valid e.g. http://www.google.co.uk
            var borderColor = '#333'; 							//Use any hex code
            var borderWeight = 10; 									//Use an integer (in pixels)
            var borderRadius = 10; 									//Use an integer (in pixels)
            var fadeOutTime = 300; 									//Use any integer, 0 = no fade
            var disableColor = '#666'; 							//Use any hex code
            var disableOpacity = 40; 								//Valid range 0-100
            var loadingImage = '';		//Use relative path from this page

            //This method initialises the modal popup
    
    $("#new").click(function() {
        modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, source, loadingImage);
    });

    //This method hides the popup when the escape key is pressed
    $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                    closePopup(fadeOutTime);
            }
    });
    
    
});
 
    