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

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Inicio está hecho para pruebas</p>            
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
                        foreach ($estudiantes as $$asist){
                            echo "<tr>";
                                echo "<td>".$$asist->getNombre()."</td>";
                                echo "<td>".$$asist->getApellido()."</td>";
                                echo "<td>".$$asist->getMail()."</td>";
                                echo "<td>".$$asist->getUsuarioEspol()."</td>";
                                echo "<td>";
                                echo link_to(image_tag('/images/delete.png', 'size=18x18'), 'Estudiante/delete?id='.
                                        $$asist->getIdUsuario(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?'));              
                                echo link_to(image_tag('/images/edit.png', 'size=18x18'), 'Estudiante/edit?id='.
                                        $$asist->getIdUsuario(), array('post=true','confirm' => 'Esta seguro que quiere Editar?'));
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                
                </tbody>
                 <thead>
                    <tr>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Correo</td>
                        <td>Usuario Espol</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
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
 