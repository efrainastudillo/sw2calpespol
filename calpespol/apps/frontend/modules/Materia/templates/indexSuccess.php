<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/education.png', array('alt_title'=>'Materia','size'=>'70x70')) ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Materias" ?>
<?php end_slot(); ?>

<?php slot('materia-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Materias</p>  
            
        </div> 
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <?php if ($sf_user->hasFlash('materia_creada')): ?>
              <div style="color: red;"><?php echo $sf_user->getFlash('materia_creada') ?></div>
            <?php endif ?>
        </div>
        
        <div class="boton_new" title="Crear Nueva Materia">
            <a href="<?php echo url_for("Materia/new")?>" class="button rounded black" id="">
                 <?php echo image_tag('add.png', 'size=15x15') ?> Nuevo Materia
            </a> 
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <?php echo sizeof($consulta) ?>
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>Materia</td>
                        <td>Paralelo</td>
                        <td>Rol</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php foreach ($consulta as $row): ?>
                            <tr>
                                <td><?php echo $row->nombre; ?></td>
                                <td><?php echo $row->paralelo; ?></td>
                                <td><?php echo $row->rol; ?></td>                          
                              <td>
                              <?php
                              if($row->rol=="Profesor"){
                                echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Curso/edit?id='.
                                        $row->getCurso()->getIdcurso(), array('post=true','confirm' => 'Esta seguro que quiere Editar?','title'=>'Editar Materia'));
                                echo '&nbsp &nbsp' ;
                                echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Curso/delete?id='.
                                        $row->getCurso()->getIdcurso(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Materia'));              
                              }
                              ?>
                              </td>
                            </tr>
                    <?php endforeach; ?>
                
                </tbody>
                
            </table>
            
	</div> 

        <?php echo 
        "<script type='text/javascript'>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:950, height:200});
            });
        </script>"
        ?>
        
    </div>

</div>