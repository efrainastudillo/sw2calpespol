<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Grupos" ?>
<?php end_slot(); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#grupo_tabla').dataTable( {
			"bLengthChange": false,
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bAutoWidth": false,
                        "aoColumnDefs": [
                            { "bSortable": false, "aTargets": [ 1 , 3 ] }
                        ],
                        "aaSorting": [[2, 'asc'],[0,'asc']]
		});
	} );
</script>
<?php if ($rol=="Ayudante"||$rol=="Profesor") echo "<input class=\"grupo_boton_eliminar\" type=\"button\" value=\"      Eliminar\" onClick=\"window.open('delete','_self')\" style=\"float: right\"/>" ?>
<?php if ($rol=="Ayudante"||$rol=="Profesor") echo "<input class=\"grupo_boton_editar\" type=\"button\" value=\"      Editar\" onClick=\"window.open('edit','_self')\" style=\"float: right\"/>" ?>
<input class="grupo_boton_nuevo" type="button" value="      Nuevo" onClick="window.open('new','_self')" style="float: right"/>
<div style="clear: both;height:10px;"></div>
<input type="hidden" id="grupo_var_curso" value="<?php echo $id_curso ?>" />
<table cellpadding="0" cellspacing="0" border="0" class="display" id="grupo_tabla">
    <thead><tr><th>Apellidos</th><th>Nombres</th><th>Grupo</th><th>Correo</th></tr></thead>
    <tbody>
    <?php foreach ($lista as $objeto): ?>
    <tr class="gradeA">
        <td><?php echo $objeto->getUsuario()->getApellido() ?></td>
        <td><?php echo $objeto->getUsuario()->getNombre() ?></td>
        <td style="text-align: center"><?php echo (Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)?"No tiene grupo":Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())->getGrupo()->getNumero() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>