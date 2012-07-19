<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<div class="panel">
    <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Registro de Actividad</p>
            </div>
            <div class="extra_head_panel">
                <p> Laboratorio de Potencia 1</p>
            </div>
    </div>
    <!--Body para mostrar actividades    -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <p> <label class="labelsForm" for="paralelo"> Paralelo: </label> </p>
            <select name="paralelo" size="1" id="parale_selec" >
                <?php foreach ($q as $para): ?>
                <option>
                    <?php echo $para->getParalelo(); ?>
                </option>
                <?php endforeach; ?>
<<<<<<< HEAD
        </select>
        <div class="boton_new" style="margin-bottom: 1em">
            <a href="Actividad/createnew" class="button rounded black" id="new">
=======
            </select>
        </div>
        
        <div class="boton_new">
            <a href="Actividad/new" class="button rounded black" id="new">
>>>>>>> 6598795502a03f4551c6454d16350fd5a84d35cd
                <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
            </a> 
        </div>
        
        <div class="tableScroll">
            <table class="tabla" cellspacing="0">
                <thead>
                    <tr>
                        <td>Descripcion</td>
                        <td>Tipo de Realizacion</td>
                        <td>Tipo de Actividad</td>
                        <td>Valor Ponderacion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui va la tabla que muestra todas las actividades-->
                    <?php foreach ($a as $acti): ?>
                        <tr>
                <!--//      Nombre de la actividad/es-->
                            <td><?php echo $acti->getNombre(); ?></td>
                <!--//      Nombre del tipo de la actividad-->
                            <td><?php echo $acti->getTipoactividad()->getNombre(); ?></td>
                <!--//      Si es grupal o individual-->
                            <td><?php if ($acti->getTipoactividad()->getEsGrupal()) echo "Grupal"; else echo "Individual"; ?></td>
                <!--//      Valor del tipo actividad, ponderacion-->
                            <td><?php echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
                            <td><a href="#" ><img src="../images/edit (2).png" width="15" height="15" /></a>
                                <a href="#" ><img src="../images/delete (2).png" width="15" height="15" /></a>
                                <a href="#" ><img src="../images/add.png" width="15" height="15" /></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo 
        "<script>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:950, height:200});

            });
        </script>"
    ?>
    
</div>