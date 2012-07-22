<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', 'alt_title=Estudiantes') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Estudiantes" ?>
<?php end_slot(); ?>

<?php slot('estudiante-css') ?>
    <?php echo "selected" ?>
<?php end_slot();?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Inicio</p>  
            
        </div>
        
        <div class="extra_head_panel">
            <p> Laboratorio de Potencia </p>
        </div>
        <div style="margin-right:200px;color: red;"  class="extra_head_panel">
           <?php if ($sf_user->hasFlash('mensaje')): ?>
              <div><?php echo $sf_user->getFlash('mensaje') ?></div>
            <?php endif ?>
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <p> Consulta de Estudiantes </p>
        </div>
        
        <div class="boton_new">
            <a href="<?php echo url_for("Estudiante/new")?>" class="button rounded black" id="">
                <img src="../images/new.png" width="15" height="15" /> Nuevo Estudiante
            </a> 
        </div>
        
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
                                echo link_to(image_tag('/images/delete.png', 'size=18x18'), 'Estudiante/delete?id='.
                                        $est->getIdUsuario(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?'));              
                                echo link_to(image_tag('/images/edit.png', 'size=18x18'), 'Estudiante/edit?id='.
                                        $est->getIdUsuario(), array('post=true','confirm' => 'Esta seguro que quiere Editar?'));
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
    
    <div class="foot_panel">
        <a class="button rounded black" href="#"> Volver a Actividades </a>
    </div>

</div>