<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Grupos" ?>
<?php end_slot(); ?>

<input type="hidden" id="grupo_var_curso" value="<?php echo $id_curso ?>" />
<table id="grupo_consulta">
    <tr><th></th><th>Apellidos</th><th>Nombres</th><th>Correo</th></tr>
    <?php foreach ($lista as $objeto): ?>
    <tr>
        <td><input type="checkbox" /></td>
        <td><?php echo $objeto->getUsuario()->getApellido() ?></td>
        <td><?php echo $objeto->getUsuario()->getNombre() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<input id="grupo_button_new" type="button" value="      Crear" onClick="window.open('Grupo/create','_self')" style="float: right"/>
<div style="clear: both"></div>