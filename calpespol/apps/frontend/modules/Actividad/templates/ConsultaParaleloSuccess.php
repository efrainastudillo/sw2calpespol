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
    <!--Body para crear una actividad    -->
    <div class="body_panel">
        <label class="labelsForm" for="paralelo"> Paralelo: </label>
        <select name="paralelo" size="1" id="parale_selec" >
                <?php foreach ($q as $para): ?>
                <option>
                    <?php echo $para->getParalelo(); ?>
                </option>
                <?php endforeach; ?>
        </select>
        <div class="boton_new">
            <a href="#" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
            </a> 
        </div>
        
        <div class="tabla_actividad">
            <a href="Actividad/actividad" style="color: #333333">Mostrar Actividades</a>
        </div>
    </div>
</div>