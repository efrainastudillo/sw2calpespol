#<table>
    <tr>
        <th>Nombre Completo</th><th>Grupo</th><th>Correo</th>
    </tr>
<?php foreach ($estudiantes as $estudiante): ?>
<tr>
    <td><?php echo $estudiante->getUsuario()->getNombre()?></td>
    <td><?php echo ($estudiante->getGrupo()->getNumero()==null)?"No tiene grupo":$estudiante->getGrupo()->getNumero() ?></td>
    <td><?php echo $estudiante->getUsuario()->getMail()?></td>
</tr>
<?php endforeach; ?>
</table>#