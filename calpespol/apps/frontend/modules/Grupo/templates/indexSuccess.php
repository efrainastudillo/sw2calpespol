<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Grupos" ?>
<?php end_slot(); ?>

<input id="grupo_button_new" type="button" value="      Nuevo" onClick="window.open('Grupo/new','_self')" style="float: right"/>
<?php if (strcasecmp($rol,"Ayudante")||strcasecmp($rol,"Profesor")) echo "<input id=\"grupo_button_edit\" type=\"button\" value=\"      Editar\" onClick=\"window.open('Grupo/edit')\" style=\"float: right\"/>" ?>
<?php if (strcasecmp($rol,"Ayudante")||strcasecmp($rol,"Profesor")) echo "<input id=\"grupo_button_delete\" type=\"button\" value=\"      Eliminar\" onClick=\"window.open('Grupo/delete')\" style=\"float: right\"/>" ?>
<div style="clear: both"></div>
<input type="hidden" id="grupo_var_curso" value="<?php echo $id_curso ?>" />
<table id="grupo_consulta">
    <tr><th>Apellidos</th><th>Nombres</th><th>Grupo</th><th>Correo</th></tr>
    <?php foreach ($lista as $objeto): ?>
    <tr>
        <td><?php echo $objeto->getUsuario()->getApellido() ?></td>
        <td><?php echo $objeto->getUsuario()->getNombre() ?></td>
        <td style="text-align: center"><?php echo (Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())==null)?"No tiene grupo":Estudiantegrupo::getGrupoDeEstudiante($objeto->getIdUsuarioCurso())->getGrupo()->getNumero() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
</table>