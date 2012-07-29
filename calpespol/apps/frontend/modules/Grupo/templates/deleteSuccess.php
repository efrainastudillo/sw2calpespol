<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Eliminar - Grupo" ?>
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
                            { "bSortable": false, "aTargets": [ 2 ] }
                        ],
                        "aaSorting": [[0, 'asc'],[1, 'asc']]
		});
	} );
</script>
<div style="clear: both;height:10px;"></div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="grupo_tabla">
    <thead><tr><th>Grupo</th><th>Nombre Completo</th><th>Acciones</th></tr></thead>
    <tbody>
        <?php foreach ($lista as $objeto): ?>
            <?php foreach ($objeto->getEstudiantegrupo() as $elemento): ?>
                <tr class="gradeA">
                    <td style="text-align: center"><?php echo $objeto->getNumero() ?></td>
                    <td><?php echo $elemento->getUsuarioCurso()->getUsuario()->getApellido()." ".$elemento->getUsuarioCurso()->getUsuario()->getNombre() ?></td>
                    <td style="text-align: right"><input class="grupo_boton_eliminar" type="button" value="      Eliminar" onClick="eliminarGrupo('<?php echo $elemento->getIdGrupo() ?>','<?php echo $elemento->getIdEstudiante() ?>');"/></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>