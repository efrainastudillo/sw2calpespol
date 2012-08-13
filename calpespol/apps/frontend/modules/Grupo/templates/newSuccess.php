<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Grupo" ?>
<?php end_slot(); ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Grupos</p>  
            
        </div>
        
        <div class="extra_head_panel">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div class="extra_head_panel">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>   
    </div>
    <br/>
    <div class="body_panel">
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#grupo_tabla').dataTable( {
			"sScrollY": "350px",
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
<?php if(sizeof($lista)>0){echo '<input class="grupo_boton_nuevo" type="button" value="      Crear" onClick="crearGrupo();" style="float: right"/>';} ?>

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
    </div>
</div>