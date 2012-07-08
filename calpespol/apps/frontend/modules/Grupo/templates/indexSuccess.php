<?php use_stylesheet('grupos.css') ?>
<?php use_javascript('grupo.js') ?>
Año <input type="text" size="20" id="grupo_var_anio" placeholder="Ingrese año" maxlength="4" onkeypress="return onlyNumbers(event)" onkeyup="consultarMaterias();"/>
Termino <input type="text" size="20" id="grupo_var_termino" placeholder="Ingrese paralelo" maxlength="1" onkeypress="return onlyNumbers(event)" onkeyup="consultarMaterias();"/>
Materia <select size="1" id="grupo_var_materia" onchange="consultarParalelos();">
	<option>Seleccione una materia</option>
</select>
Paralelo <select size="1" id="grupo_var_paralelo">
	<option>Seleccione un paralelo</option>
</select>
<input id="grupo_consultar" type="button" value="Buscar" onclick="consultarEstudiantes();"/>
<input id="grupo_reset" type="button" value="Nueva Consulta" onclick="limpiarCampos();" style="display:none"/>
<input id="grupo_nuevo" type="button" value="Nuevo Grupo" onclick="nuevoGrupo();" style="display:none"/>
<div id="grupo_var_subcontent" width="100%"></div>