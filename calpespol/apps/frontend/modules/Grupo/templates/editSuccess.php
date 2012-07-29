<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Editar - Grupo" ?>
<?php end_slot(); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#grupo_tabla_1').dataTable( {
			"sScrollY": "300px",
			"bPaginate": false,
			"bScrollCollapse": true,
			"bLengthChange": false,
			"bFilter": true,
			"bSort": true,
			"bInfo": false,
			"bAutoWidth": false,
                        "aoColumnDefs": [
                            { "bSortable": false, "aTargets": [ 0 ] }
                        ],
                        "aaSorting": [[1, 'asc'],[2, 'asc']]
		});
	} );
</script>
<div id="grupo_div_subtabla" ></div>
<div style="clear: both;height:10px;"></div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="grupo_tabla_1">
    <thead><tr><th></th><th style="text-align: center">Grupo</th><th>Integrantes</th></tr></thead>
    <tbody>
        <?php foreach ($lista as $objeto): ?>
            <tr class="gradeA">
                <td><input class="grupo_boton_editar" alt="Desactivado"  type="button" value="     " onClick="window.open('agregar?grupo=<?php echo $objeto->getIdgrupo() ?>','_self')"/></td>
                <td><?php echo $objeto->getNombre() ?></td>
                <td style="text-align: center"><?php echo sizeof($objeto->getEstudiantegrupo()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>