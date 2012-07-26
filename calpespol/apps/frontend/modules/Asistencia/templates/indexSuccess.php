<?php slot('logo') ?>
    <?php echo image_tag('/images/asistencias.png', 'alt_title=Asistencias') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Asistencia" ?>
<?php end_slot(); ?>

<?php slot('asistencia-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php use_stylesheet('modulo/estilo.css') ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Consulta de Estudiantes</p>  
            
        </div>
        
        <div class="extra_head_panel">
            <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
        
        <div style="margin-right:200px;color: red;"  class="extra_head_panel">
           <?php if ($sf_user->hasFlash('mensaje')): ?>
              <div><?php echo $sf_user->getFlash('mensaje') ?></div>
            <?php endif ?>
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
        
        <div class="boton_new" title="Crear Nuevo Estudiante">
            <a href="<?php echo url_for("Estudiante/new")?>" class="button rounded black" id="">
                <img src="../images/new.png" width="15" height="15"/> Nuevo Estudiante
            </a> 
        </div>
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
                    if(isset ($estudiantes)){
                        foreach ($estudiantes as $est){
                            echo "<tr>";
                                echo "<td>".$est->getNombre()."</td>";
                                echo "<td>".$est->getApellido()."</td>";
                                echo "<td>".$est->getMail()."</td>";
                                echo "<td>".$est->getUsuarioEspol()."</td>";
                                echo "<td>";
                                echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Estudiante/edit?id='.
                                        $est->getIdUsuario(), array('post=true','confirm' => 'Esta seguro que quiere Editar?','title'=>'Editar Estudiante'));
                                echo '&nbsp &nbsp' ;
                                echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Estudiante/delete?id='.
                                        $est->getIdUsuario(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Estudiante'));              
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
        "<script>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:950, height:200});

            });
        </script>"
        ?>
        
    </div>

</div>