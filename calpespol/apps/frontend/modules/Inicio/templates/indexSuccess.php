<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/inicio.png', 'alt_title=Inicio') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Inicio" ?>
<?php end_slot(); ?>

<?php slot('inicio-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<h1>Authenticacion con Servicio Web</h1>
<?php 
    echo $variable;
    echo $fecha;
    if($sf_user->isEstudiante()){
      echo "Estudiante"  ;
    }else {echo "profesor";}
    ?>

 