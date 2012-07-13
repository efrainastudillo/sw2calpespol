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
            <a href="javascript:void(0);" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Eliminar
            </a> 
        </div>
        <div class="boton_new">
            <a href="javascript:void(0);" class="button rounded black" id="">
                <img src="../images/new.png" width="15" height="15" /> Nuevo Estudiante
            </a> 
        </div>
        
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                </thead>

                <tbody>
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
                    </tr>
                    
                    
                    
                </tbody>

                <tfoot>
                    <tr>
                        <td>&nbsp;</td>
                        <td id="estilo1_celda">TOTAL</td>
                        <td class="total" id="estilo2_celda">Total</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
                
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