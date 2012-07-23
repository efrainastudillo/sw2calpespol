<!-- Reporte del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
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
    <form id="formulario" style="margin-left: 13em; margin-top: 2em" action="new">
        <label>Tipo de Actividad: </label>
        <select name="tipoactivid" size="1" id="tipo_acti" style="margin-left: 5em">
            <?php foreach ($ta as $tipoact): ?>
                <option>
                    <?php echo $tipoact->getNombre(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br/>
        <label>Descripcion de la actividad: </label>
        <input type="text" name="descripcion" value="" /><br/>
        <label> Fecha de entrega: </label>
        <input name="fecha" type="date" id="fecha" style="margin-left: 4.7em"/><br/>
        <label> Nota: </label>
        <input type="text" name="nota" value="" style="margin-left: 11.7em"/><br/>
        <!--Boton que crea la actividad-->
        <div id="grabar_actividad" style="margin-left: 15em; margin-top: 1em">
            <a href="#" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Crear Actividad
            </a> 
        </div>
        <div class="boton_new">
            <a href="Actividad/actividad" class="button rounded black" id="new" style="margin-top: -3.5em; margin-left: -30em">
                <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
            </a> 
        </div>
    </form>
</div>