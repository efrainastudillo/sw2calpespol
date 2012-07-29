/**
 * Función que me retorna el objeto ajax
 */
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

/**
 * 
 */
function crearGrupo(){
	var tabla = document.getElementById('grupo_tabla');
	var rows = tabla.getElementsByTagName('tbody').item(0).getElementsByTagName('tr');
	var lista = Array(0);
	for (var i = 0; i<rows.length;i++)
            if(rows.item(i).getElementsByTagName('input').item(0).checked)
		lista.push(rows.item(i).getElementsByTagName('input').item(0));
	if(lista.length==0)
		jAlert('No se puede crear grupo vacío, seleccione al menos un estudiante.', 'CALPESPOL');
	else{
		var ajax = ajaxFunction();
		var txt = "size="+lista.length;
		var curso = document.getElementById('grupo_var_curso').value;
		txt = txt + "&curso="+curso;
		for(var j=0;j<lista.length;j++)
			txt = txt + "&param"+j+"="+lista[j].getAttribute("name");
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4 && ajax.status==200){
                            var mensaje = ajax.responseText;
                            mensaje = mensaje.substring(mensaje.indexOf("div_contenedor_template"), mensaje.length)
                            mensaje = mensaje.substring(mensaje.indexOf(">")+1, mensaje.indexOf("</div>"))
                            jAlert(mensaje, 'CALPESPOL');
                            window.open('index','_self');
			}
		}
		ajax.open("GET","create?"+txt,true);
		ajax.send();
	}
}