<?php use_stylesheet('grupos.css') ?>
<?php use_javascript('grupo.js') ?>
<form method="get" enctype="text/plain">
<h2 id="var_subtitulo">Consulta de grupos por paralelo</h2>
Año <input type="text" size="20" id="grupo_var_anio" maxlength="4" onkeyup="consultarMaterias()" onchange="consultarMaterias()"/>
Termino <input type="text" size="20" id="grupo_var_termino" maxlength="1" onkeyup="consultarMaterias()" onchange="consultarMaterias()"/>
Materia <select size="1" id="grupo_var_materia" onchange="consultarParalelos()">
	<option>Seleccione una materia</option>
</select>
Paralelo <select size="1" id="grupo_var_paralelo">
	<option>Seleccione un paralelo</option>
</select>
<input id="grupo_consultar" type="button" value="Buscar" onclick="consultarGrupos()"/>
<input id="grupo_reset" type="button" value="Nueva Consulta" onclick="limpiarCampos()" />
<input id="grupo_nuevo" type="button" value="Nuevo Grupo" onclick="nuevoGrupo()"/>
</form>
<div id="grupo_var_subcontent" width="100%"></div>