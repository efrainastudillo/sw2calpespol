<!-- Modulo Actividad, para crear Tipo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Tipo Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_javascript('tipoactividad.js') ?>
<?php use_stylesheet("modulo/actividad/actividad.css")?>

<div class="panel">

        <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Registro de Tipo de Actividad</p>
            </div>
            <div class="extra_head_panel">
                <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
            </div>
        </div>
    <!--Body para crear una actividad    -->
    <form id="formulario" style="margin-left: 13em; margin-top: 2em" action="process">
        <label>Nombre del tipo actividad: </label>
        <input id="tipo_acti" type="text" name="tipoactividad" value="" style="margin-left: 3.1em" />
        <span id="req-tipacti">Tiene desahabilitado el JavaScript</span><br/>
        
        <label>Tipo de Realizacion: </label>
        <select name="tiporealizacion" size="1" id="tipo_reali" style="margin-left: 6em">
            <option>Individual</option>
            <option>Grupal</option>
        </select><span id="req-selec1">Tiene desahabilitado el JavaScript</span><br/>
        
        <label>Tipo de la actividad: </label>
        <select name="extra" size="1" id="extra" style="margin-left: 6.1em">
            <option>Ordinaria</option>
            <option>Extra</option>
        </select><span id="req-selec2">Tiene desahabilitado el JavaScript</span><br/>
        
        <label>Parcial: </label>
        <select name="parcial" size="1" id="parcial" style="margin-left: 12.8em">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select><span id="req-selec3">Tiene desahabilitado el JavaScript</span><br/>
        
        <label>Ponderacion: </label>
        <input id="ponde" type="text" name="ponderacion" value="" style="margin-left: 9.7em"/>
        <span id="req-pond">Tiene desahabilitado el JavaScript</span><br/>
        <!--Boton que crea el tipo actividad-->
        <div id="grabar_actividad" style="margin-left: 10em; margin-top: 1.5em;" >
            <a href="#" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Guardar
            </a> 
        </div>
        <div style="margin-top: -1.9em; margin-left: 17em">
            <a href="<?php echo url_for("Actividad/NewView")?>" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Cancelar
            </a> 
        </div>
    </form>

</div>




