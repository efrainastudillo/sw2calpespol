function ajaxFunction(){
 var ajaxRequest;  // The variable that makes Ajax possible!
	
 try{
   // Opera 8.0+, Firefox, Safari
   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   // Internet Explorer Browsers
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         alert("Tu navegador no soporta AJAX!");
      }
   }
 }
 return ajaxRequest;
}

function consultarMaterias() {
   var ajax = ajaxFunction();
   ajax.onreadystatechange = function(){
    if (ajax.readyState == 4) 
        if (ajax.status == 200) {
            while(document.getElementById('grupo_var_materia').options.length>0)
                document.getElementById('grupo_var_materia').remove(0);
            var texto = ajax.responseText;
            texto = texto.substring(texto.indexOf("div_contenedor_template"), texto.length);
            texto = texto.substring(texto.indexOf(">")+1, texto.indexOf("</div>"));
            texto = texto.substring(texto.indexOf("#")+1, texto.lastIndexOf("#"));
            var opciones = texto.split("#");
            for(var count = 0; count < opciones.length-1; count++){
                var opcion = document.createElement("option");
                opcion.text = opciones[count];
                document.getElementById('grupo_var_materia').add(opcion,null);
            }
        }
   }
   var anio = document.getElementById('grupo_var_anio').value;
   var termino = document.getElementById('grupo_var_termino').value;
   if(anio==null ||anio=="")
       anio = 0;
   if(termino==null ||termino=="")
       termino = 0;
   ajax.open("GET", "Grupo/materia?anio="+anio+"&termino="+termino, true);
   ajax.send(null);
}

function consultarParalelos(){
   var ajax = ajaxFunction();
   ajax.onreadystatechange = function(){
    if (ajax.readyState == 4) 
        if (ajax.status == 200) {
            while(document.getElementById('grupo_var_paralelo').options.length>0)
                document.getElementById('grupo_var_paralelo').remove(0);
            var texto = ajax.responseText;
            texto = texto.substring(texto.indexOf("div_contenedor_template"), texto.length);
            texto = texto.substring(texto.indexOf(">")+1, texto.indexOf("</div>"));
            texto = texto.substring(texto.indexOf("#")+1, texto.lastIndexOf("#"));
            var opciones = texto.split("#");
            for(var count = 0; count < opciones.length-1; count++){
                var opcion = document.createElement("option");
                opcion.text = opciones[count];
                document.getElementById('grupo_var_paralelo').add(opcion,null);
            }
        }
   }
   var anio = document.getElementById('grupo_var_anio').value;
   var termino = document.getElementById('grupo_var_termino').value;
   var materia = document.getElementById('grupo_var_materia').options[document.getElementById("grupo_var_materia").selectedIndex].text;
   if(anio==null ||anio=="")
       anio = 0;
   if(termino==null ||termino=="")
       termino = 0;
   if(materia==null)
       materia="Seleccione una materia";
   ajax.open("GET", "Grupo/paralelo?anio="+anio+"&termino="+termino+"&materia="+materia, true);
   ajax.send(null);
}

function consultarGrupos(){
    var anio = document.getElementById('grupo_var_anio').value;
    var termino = document.getElementById('grupo_var_termino').value;
    var materia = document.getElementById('grupo_var_materia').options[document.getElementById("grupo_var_materia").selectedIndex].text;
    var paralelo = document.getElementById('grupo_var_paralelo').options[document.getElementById("grupo_var_paralelo").selectedIndex].text;
    if(anio==null ||anio=="")
        alert('Debe ingresar un año');
    else if(termino==null ||termino=="")
        alert('Debe ingresar un termino');
    else if(materia==null||materia=="Seleccione una materia")
        alert('Debe seleccionar una materia');
    else if(paralelo==null||paralelo=="Seleccione un paralelo")
        alert('Debe seleccionar un paralelo');
    else{
        var ajax = ajaxFunction();
        ajax.onreadystatechange = function(){
            if (ajax.readyState == 4) 
                if (ajax.status == 200) {
                    var texto = ajax.responseText;
                    texto = texto.substring(texto.indexOf("div_contenedor_template"), texto.length);
                    texto = texto.substring(texto.indexOf(">")+1, texto.indexOf("</div>"));
                    texto = texto.substring(texto.indexOf("#")+1, texto.lastIndexOf("#"));
                    document.getElementById('grupo_var_subcontent').innerHTML = texto;
                    document.getElementById('grupo_consultar').style.display = 'none';
                    document.getElementById('grupo_reset').style.display = 'inline';
                    document.getElementById('grupo_nuevo').style.display = 'inline';
                }
        }
        ajax.open("GET", "Grupo/consulta?anio="+anio+"&termino="+termino+"&materia="+materia+"&paralelo="+paralelo, true);
        ajax.send(null);
    }
}

function limpiarCampos(){
    document.getElementById('grupo_var_anio').value = "";
    document.getElementById('grupo_var_termino').value = "";
    while(document.getElementById('grupo_var_materia').options.length>0)
        document.getElementById('grupo_var_materia').remove(0);
    var opcion = document.createElement("option");
    opcion.text = "Seleccionar una materia";
    document.getElementById('grupo_var_materia').add(opcion,null);
    while(document.getElementById('grupo_var_paralelo').options.length>0)
        document.getElementById('grupo_var_paralelo').remove(0);
    opcion = document.createElement("option");
    opcion.text = "Seleccionar un paralelo";
    document.getElementById('grupo_var_paralelo').add(opcion,null);
    document.getElementById('grupo_consultar').style.display = 'inline';
    document.getElementById('grupo_reset').style.display = 'none';
    document.getElementById('grupo_nuevo').style.display = 'none';
}

function nuevoGrupo(){
    
}