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
        
        <div class="extra_head_panel">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div class="extra_head_panel">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>   
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <?php if ($sf_user->hasFlash('materia_creada')): ?>
              <div style="color: red;"><?php echo $sf_user->getFlash('materia_creada') ?></div>
            <?php endif ?>
        </div>
        
        <div class="boton_new" title="Crear Nuevo Materia">
            <a href="<?php echo url_for("Materia/new")?>" class="button rounded black" id="">
                 <?php echo image_tag('add.png', 'size=15x15') ?> Nuevo Materia
            </a> 
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Codigo</td> 
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php 
                    if(isset ($materias)){
                        foreach ($materias as $asist){
                            echo "<tr>";
                                echo "<td>".$asist->getIdMateria()."</td>";
                                echo "<td>".$asist->getNombre()."</td>";
                                echo "<td>".$asist->getCodigoMateria()."</td>";                            
                              echo "<td>";
                                echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Materia/edit?id='.
                                        $asist->getIdMateria(), array('post=true','confirm' => 'Esta seguro que quiere Editar?','title'=>'Editar Materia'));
                                echo '&nbsp &nbsp' ;
                                echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Materia/delete?id='.
                                        $asist->getIdMateria(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Materia'));              
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                
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