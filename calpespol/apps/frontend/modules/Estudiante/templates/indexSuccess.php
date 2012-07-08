<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', 'alt_title=Estudiantes') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Estudiantes" ?>
<?php end_slot(); ?>

<?php slot('estudiante-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php use_stylesheet('modulo/estilo.css') ?>

<div class="panel">  
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Lista de Estudiantes</p>    
        </div>
        
    </div>   
<!--    <div id="info">
            <div id="contenido_izq">
               Lista de Estudiantes
            </div>
    </div>-->
    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <p> MATERIA: </p>
            <p> Laboratorio de Potencia </p>  
        </div>       
        
        <div class="boton_new">
            <a href="<?php echo url_for('Estudiante/new') ?>" class="button rounded black" id="new">
                <span><img src="../images/new.png">&nbsp</span>Nuevo Estudiante
            </a> 
        </div>
        
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>Id Estudiante</td>
                        <td>Nombre</td>
                        <td>Email</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($estudiantes as $estudiante): ?>
                    <tr>
                        <td><?php echo $estudiante->getId() ?></a></td>
                        <td><?php echo $estudiante->getNombre() ?></td>
                        <td><?php echo $estudiante->getMail() ?></td>
                    </tr>
                    <?php endforeach; ?>    
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">
                            &nbsp;
<!--                            <a href="<?php // echo url_for('Estudiante/new') ?>">New</a>-->
                        </td>
                    </tr>
                </tfoot>
                
            </table>
            
	</div>
        <?php echo 
        "<script>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:900, height:200});

            });
        </script>"
        ?>
        
    </div>

<!--    <div id="contenedor_tabla" class="contenedor_tabla">
<table>
  <thead>
    <tr>
      <th>Id Estudiante</th>
      <th>Nombre</th>
      <th>E-mail</th>
    </tr>
  </thead>
  <tbody>
    <?php // foreach ($estudiantes as $estudiante): ?>
    <tr>
      <td><a href="<?php // echo url_for('Estudiante/edit?id='.$estudiante->getId()) ?>"><?php echo $estudiante->getId() ?></a></td>
      <td><?php // echo $estudiante->getNombre() ?></td>
      <td><?php // echo $estudiante->getMail() ?></td>
    </tr>
    <?php // endforeach; ?>
  </tbody>
  <tfoot>
      <tr>
        <td colspan="3">
            <a href="<?php // echo url_for('Estudiante/new') ?>">New</a>
        </td>
      </tr>
  </tfoot>
</table>
    </div>-->
</div>

  
