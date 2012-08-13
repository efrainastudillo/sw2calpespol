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
    <form style="margin-left: 13em; margin-top: 2em" action="createnew">
            <label>Tipo de Actividad: </label>
            <select name="tipoactivid" size="1" id="tipo_acti" style="margin-left: 5.1em">
                <?php foreach ($ta as $tipoact): ?>
                <option>
                    <?php echo $tipoact->getNombre(); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <a href="#" style="color: black"><img src="../images/new.png" width="15" height="15" /> Crear</a>
            <br/>
<!--            <input type="text" name="tipoactividad" value="" style="margin-left: 5.1em" name="tipoactividad" /><br/>-->
            <label>Descripcion: </label>
            <input type="text" name="descripcion" value="" style="margin-left: 8em"/><br/>
            <label>Tipo de Realizacion: </label>
            <select name="periodos" size="1" id="periodo_selec" style="margin-left: 3.9em">
                            <option>Individual</option>
                            <option>Grupal</option>
            </select><br/>
            <label> Fecha de entrega: </label>
            <input name="fecha" type="date" id="fecha" style="margin-left: 4.8em"/><br/>
            <label> Ponderacion: </label>
            <input type="text" name="ponderacion" value="" style="margin-left: 7.5em"/><br/>
            <label> Paralelo: </label>
            <input type="text" name="paralelo" value="" style="margin-left: 9.9em"/><br/>
            <!--Boton que crea la actividad-->
            <div style="margin-left: 20em; margin-top: 1em">
                <a href="Actividad/new" class="button rounded black" id="new">
                    <img src="../images/new.png" width="15" height="15" /> Crear
                </a> 
            </div>
    </form>
</div>