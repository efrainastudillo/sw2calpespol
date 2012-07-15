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
        <select href="Actividad/ConsultaParalelo" />
        <div class="boton_new">
            <a href="Actividad/new" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Crear Nueva Actividad
            </a> 
        </div>
        <div id="tabla">

        </div>
    </div>


    
   
</div>