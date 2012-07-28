<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Grupos" ?>
<?php end_slot(); ?>
<?php use_stylesheet('grupos.css') ?>
<?php use_javascript('grupo.js') ?>
Materia: <?php echo $sf_user->getMateriaActual() ?><br/>
Paralelo: <?php echo $sf_user->getParaleloActual() ?><br/>
Rol Usuario: <?php echo $sf_user->getRol() ?><br/>
Es estudiante?: <?php echo $sf_user->isEstudiante() ?><br/>
<input id="grupo_button_new" type="button" value="      Editar" onClick="window.open('Grupo/new')" style="float: right"/>
<?php if (!$sf_user->isEstudiante()) echo "<input id=\"grupo_button_edit\" type=\"button\" value=\"      Editar\" onClick=\"window.open('Grupo/edit')\" style=\"float: right\"/>" ?>
<?php if (!$sf_user->isEstudiante()) echo "<input id=\"grupo_button_delete\" type=\"button\" value=\"      Eliminar\" onClick=\"window.open('Grupo/delete')\" style=\"float: right\"/>" ?>
<div style="clear: both"></div>
<table id="grupo_consulta">
    <tr>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>Grupo</th>
        <th>Correo</th>
    </tr>
    <?php foreach ($lista as $objeto): ?>
    <tr>
        <td><?php echo $objeto->getUsuario()->getApellido() ?></td>
        <td><?php echo $objeto->getUsuario()->getNombre() ?></td>
        <td style="text-align: center"><?php echo (Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)?"No tiene grupo":Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())->getGrupo()->getNumero() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php echo 
        "<script type='text/javascript'>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:950, height:200});
            });
        </script>"
        ?>