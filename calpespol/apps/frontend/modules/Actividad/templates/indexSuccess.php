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
                <p>Consulta de Actividad</p>
            </div>
            <div class="extra_head_panel">
                <p> Laboratorio de Potencia 1</p>
            </div>
    </div>
    <!--Body para mostrar actividades    -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <!--div que contiene al comboBox de paralelos    -->
            <div>
               <p> <label class="labelsForm" for="paralelo"> Paralelo: </label> </p>
               <select name="paralelo" size="1" id="parale_selec" >
                    <?php foreach ($q as $para): ?>
                    <option>
                        <?php echo $para->getParalelo(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
           </div>
           <!--div que contiene al comboBox de materias    -->
           <div>
               <p> <label class="labelsForm" for="paralelo"> Materia: </label> </p>
               <select name="materia" size="1" id="materia_selecionada" >
                    <?php foreach ($m as $mat): ?>
                    <option>
                        <?php echo $mat->getNombre(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
           </div>
           <!--div que contiene al comboBox de termino    -->
           <div>
               <p> <label class="labelsForm" for="paralelo"> Termino: </label> </p>
               <select name="termino" size="1" id="termino_seleccionado" >
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
           </div>
           <!--div que contiene el boton de Crear nueva actividad    -->
            <div class="boton_new" style="margin: 1em">
                <a href="#" class="button rounded black" id="new">
                    <img src="../images/new.png" width="15" height="15" /> Consultar
                </a> 
            </div>
            <!--div que contiene el boton de Crear nueva actividad    -->
            <div class="boton_new" style="margin: 1em">
                <a href="Actividad/NewView" class="button rounded black" id="new">
                    <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
                </a> 
            </div>
        
        <div class="tableScroll">
            <table class="tabla" cellspacing="0">
                <thead>
                    <tr>
                        <td>Descripcion</td>
                        <td>Tipo de Actividad</td>
                        <td>Tipo de Realizacion</td>
                        <td>Valor Ponderacion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody style="">
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
</div>