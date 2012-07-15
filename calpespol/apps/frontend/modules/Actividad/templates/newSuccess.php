<!--<h1 style="text-align: center">Nueva Actividad</h1-->

<!--?php include_partial('form', array('form' => $form)) ?>-->

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
            <p> Laboratorio de Potencia </p>
        </div>
    </div>
    
<!--Body para crear una actividad    -->

    <div class="body_panel">
        <label class="labelsForm" for="tipoactividad">Tipo de Actividad: </label>
        <input type="text" name="tipoactividad" value="" /> <br/>
        <label class="labelsForm" for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" value="" /><br/>
        <label class="labelsForm" for="tiporealizacion">Tipo de Realizacion: </label>
        <select name="periodos" size="1" id="periodo_selec" >
                        <option>Individual</option>
                        <option>Grupal</option>
        </select><br/>
        <label class="labelsForm" for="fecha"> Fecha de entrega: </label>
        <input name="fecha" type="date" id="fecha"/><br/>
        <label class="labelsForm" for="ponderacion"> Ponderacion: </label>
        <input type="text" name="ponderacion" value="" /><br/>
        <label class="labelsForm" for="paralelo"> Paralelo: </label>
        <input type="text" name="paralelo" value="" /><br/>
    </div>
    <div class="boton_new">
        <a href="Rubrica/index" class="button rounded black" id="new">
            <img src="../images/new.png" width="15" height="15" /> Crear
        </a> 
    </div>
   
</div>