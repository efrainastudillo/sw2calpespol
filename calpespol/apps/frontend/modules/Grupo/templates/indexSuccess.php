<?php slot('logo') ?>
    <?php echo image_tag('/images/grupo.png', 'alt_title=Grupos') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Grupos" ?>
<?php end_slot(); ?>

<?php use_stylesheet('grupos.css') ?>
<?php use_javascript('grupo.js') ?>
<table class="tabla" cellspacing="0">
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
        <td><?php echo ($objeto->getEstudiantegrupo()->getIdgrupo()==null)?"No tiene grupo":$objeto->getEstudiantegrupo()->getGrupo()->getNumero() ?></td>
        <td><?php echo $objeto->getUsuario()->getMail() ?></td>
    </tr>
    <?php endforeach; ?>
</table>