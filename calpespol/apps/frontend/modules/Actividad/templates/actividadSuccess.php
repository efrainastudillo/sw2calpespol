<table border="1">
    
<?php foreach ($actividad as $acti): ?>
    <tr>
<!--//          Nombre de la actividad/es-->
            <td><?php echo $acti->getNombre(); ?></td>
<!--//          Nombre del tipo de la actividad-->
            <td><?php echo $acti->getTipoactividad()->getNombre(); ?></td>
<!--//          Si es grupal o individual-->
            <td><?php echo $acti->getTipoactividad()->getEsGrupal(); ?></td>
<!--//          Valor del tipo actividad, ponderacion-->
            <td><?php echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
    </tr>
<?php endforeach; ?>

</table>
