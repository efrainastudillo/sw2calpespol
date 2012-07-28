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
<?php use_javascript('editactividad.js') ?>
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

    <!--Body para crear una actividad    -->
    <form id="formulario" style="margin-left: 13em; margin-top: 2em" action="new">
        <label>Tipo de Actividad: </label>
        <label name="tipoactivid" style="margin-left: 4.2em">
            <?php foreach ($ta as $tipoacti): ?>
                <?php echo $tipoacti->getNombre(); ?>
            <?php endforeach; ?>
        </label><br/>
        <label>Descripcion de la actividad: </label>
        <input id="descrip" type="text" name="descripcion" value="" />
        <span id="req-descripcion">Tiene desahabilitado el JavaScript</span><br/>
        <label> Fecha de entrega: </label>
        <input name="fecha" type="date" id="fecha" style="margin-left: 4.7em"/><br/>
        <label> Nota: </label>
        <input id="grade" type="text" name="nota" value="" style="margin-left: 11.7em"/>
        <span id="req-nota">Tiene desahabilitado el JavaScript</span><br/>
        <!--Boton que crea la actividad-->
        <div id="grabar_actividad" style="margin-left: 15em; margin-top: 1em">
            <a href="#" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Actualizar
            </a> 
        </div>
    </form>
</div>