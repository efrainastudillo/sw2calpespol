<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', 'alt_title=Ayudantes') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Ayudantes" ?>
<?php end_slot(); ?>

<?php slot('ayudante-css') ?>
    <?php echo "selected" ?>
<?php end_slot();?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Ayudantes</p>  
            
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
            <?php if ($sf_user->hasFlash('mensaje')): ?>
              <div style="color: red;"><?php echo $sf_user->getFlash('mensaje') ?></div>
            <?php endif ?>
        </div>
         <?php if ($sf_user->isEstudiante()): ?>
        <div class="boton_new" title="Crear Nuevo Ayudante">
            <a href="<?php echo url_for("Ayudante/new")?>" class="button rounded black" id="">
                <?php echo image_tag('add.png', 'size=15x15')?> Nuevo Ayudante
            </a> 
        </div>
        <?php endif ?>
        <div style="clear: both;visibility: hidden"></div>
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Correo</td>
                        <td>Usuario Espol</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php 
                    if(isset ($ayudantes)){
                        foreach ($ayudantes as $asist){
                            echo "<tr>";
                                echo "<td>".$asist->getNombre()."</td>";
                                echo "<td>".$asist->getApellido()."</td>";
                                echo "<td>".$asist->getMail()."</td>";
                                echo "<td>".$asist->getUsuarioEspol()."</td>";
                                echo "<td>";
                                echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Ayudante/edit?id='.
                                        $asist->getIdUsuario(), array('post=true','confirm' => 'Esta seguro que quiere Editar?','title'=>'Editar Estudiante'));
                                echo '&nbsp &nbsp' ;
                                echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Ayudante/delete?id='.
                                        $asist->getIdUsuario(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Estudiante'));              
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                
                </tbody>

<!--                <tfoot>
                    <tr>
                        <td>&nbsp;</td>
                        <td id="estilo1_celda">TOTAL</td>
                        <td class="total" id="estilo2_celda">Total</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>-->
                
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