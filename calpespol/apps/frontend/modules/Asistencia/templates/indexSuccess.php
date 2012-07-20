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
            <p>Inicio</p>    
        </div>
        
        <div class="extra_head_panel">
            <p> Laboratoroio de Potencia </p>
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <p> Consulta de Estudiantes </p>
        </div>
        
        <div class="boton_new">
            <a href="#" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Eliminar
            </a> 
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
                                echo "<a href='Estudiante/delete?id=".$est->getIdUsuario()."'>";
                                echo image_tag('/images/delete.png', 'size=18x18');
                                echo "</a>";
                                echo "<a href='Estudiante/edit?id=".$est->getIdUsuario()."'>";
                                echo image_tag('/images/edit.png', 'size=18x18');
                                echo "</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
<!--                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr><tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr><tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr><tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>-->
                    
                    
                    
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