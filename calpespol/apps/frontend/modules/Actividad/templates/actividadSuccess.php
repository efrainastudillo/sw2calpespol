<!-- Reporte del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Tipo Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_javascript('actividad.js') ?>

<div class="panel">

        <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Registro de Actividad</p>
            </div>
            <div class="extra_head_panel">
                <p> Laboratorio de Potencia 1</p>
            </div>
        </div>
    <!--Body para crear una actividad    -->
    <form id="formulario" style="margin-left: 13em; margin-top: 2em" action="process">
        <label>Nombre del tipo actividad: </label>
        <input type="text" name="tipoactividad" value=""/><br/>
        <label>Tipo de Realizacion: </label>
        <select name="tiporealizacion" size="1" id="tipo_reali">
            <option>Individual</option>
            <option>Grupal</option>
        </select><br/>
        <label>Ponderacion: </label>
        <input type="text" name="ponderacion" value=""/><br/>
        <!--Boton que crea el tipo actividad-->
        <div id="grabar_actividad" style="margin-left: 20em; margin-top: 1em">
            <a href="#" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Crear tipo actividad
            </a> 
        </div>
    </form>
</div>




