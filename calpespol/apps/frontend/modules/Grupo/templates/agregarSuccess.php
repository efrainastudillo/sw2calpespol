<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Agregar - Grupo" ?>
<?php end_slot(); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#grupo_tabla').dataTable( {
			"sScrollY": "400px",
			"bPaginate": false,
			"bScrollCollapse": true,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": true,
			"bInfo": false,
			"bAutoWidth": false,
                        "aoColumnDefs": [
                            { "bSortable": false, "aTargets": [ 0 , 3 ] }
                        ],
                        "aaSorting": [[1, 'asc'],[2,'asc']]
		});
	} );
</script>
<input type="hidden" id="grupo_var_curso" value="<?php echo $id_curso ?>"/>
<input class="grupo_boton_nuevo" type="button" value="      Agregar" onClick="agregarEstudianteAGrupo('<?php echo $grupo ?>');" style="float: right"/>

<div style="clear: both;height:10px;"></div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="grupo_tabla">
    <thead><tr><th></th><th>Apellidos</th><th>Nombres</th><th>Correo</th></tr></thead>
    <tbody>
    <?php foreach ($lista as $objeto): ?>
    <tr class="gradeA">
        <td><input type="checkbox" name="<?php echo $objeto->getIdUsuarioCurso() ?>" title="Seleccionar" /></td>
        <td><?php echo $objeto->getUsuario()->getApellido() ?></td>
        <td><?php echo $objeto->getUsuario()->getNombre() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>