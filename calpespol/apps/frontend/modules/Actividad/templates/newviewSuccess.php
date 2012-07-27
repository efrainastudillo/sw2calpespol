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
<?php use_stylesheet("modulo/actividad/actividad.css")?>

<div class="panel">

        <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Registro de Actividad</p>
            </div>
            <div class="extra_head_panel">
                <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
            </div>
        </div>
    <div style="clear: both;visibility: hidden"></div>
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
        <!--DESCRIPCION DE LA ACTIVIDAD-->
        <label>Descripcion de la actividad: </label>
        <input id="descrip" type="text" name="descripcion" value="" />
        <span id="req-descripcion">Tiene desahabilitado el JavaScript</span><br/>
        <!--FECHA DE ENTRADA-->
        <label> Fecha de entrega: </label>
        <input id="date" name="fecha" type="date" id="fecha" style="margin-left: 4.7em"/>
        <span id="req-fecha">Tiene desahabilitado el JavaScript</span><br/>
        <!--INGRESO DE LA NOTA-->
        <label> Nota: </label>
        <input id="grade" type="text" name="nota" value="" style="margin-left: 11.7em"/>
        <!--Prueba para que aparezca o desaparezca el mensaje de validacion-->
        <span id="req-nota">Tiene desahabilitado el JavaScript</span><br/>
        <!--Boton que crea la actividad-->
        <div id="grabar_actividad" style="margin-left: 15em; margin-top: 1em">
            <a href="#" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Crear Actividad
            </a> 
        </div>
        <div class="boton_new">
            <a href="Actividad/actividad" class="button rounded black" id="new" style="margin-top: -2.9em; margin-left: -30em">
                <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
            </a> 
        </div>
    </form>
</div>