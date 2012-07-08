#<input type="button" value="Crear" onclick="crearGrupo();"/>
<input type="hidden" id="grupo_var_idcurso" value="<?php echo $estudiantes[0]->getIdCurso() ?>"/>
<table id="grupo_table_estudiantes" >
    <tr>
        <th></th><th>Nombre Completo</th><th>Correo</th>
    </tr>
<?php foreach ($estudiantes as $estudiante): ?>
<tr>
    <td><input type="checkbox" id="<?php echo $estudiante->getIdUsuario()?>"></td>
    <td><?php echo $estudiante->getUsuario()->getNombre()?></td>
    <td><?php echo $estudiante->getUsuario()->getMail()?></td>
</tr>
<?php endforeach; ?>
</table>#