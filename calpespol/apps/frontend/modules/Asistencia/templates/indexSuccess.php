<?php slot('logo') ?>
    <?php echo image_tag('/images/asistencias.png', 'alt_title=Asistencias') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <div id="prueba"><?php echo "Asistencia" ?></div>
<?php end_slot(); ?>

<?php slot('asistencia-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Consulta de Asistencias</p>  
            
        </div>
        
        <div id="info_paralelo" class="extra_head_panel">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div id="info_materia" class="extra_head_panel">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
        
        
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <form id="formulario_fecha" method="POST" action="<?php echo url_for("Asistencia/index")?>">
                <label for="usuario" >Seleccione la fecha:</label>                    
                <input id="fecha" name="fecha" type="text" style="width: 50px;"/>
            </form>
           <?php if ($sf_user->hasFlash('mensaje')): ?>
              <span style="margin-left: 50px;color: red;"><?php echo $sf_user->getFlash('mensaje') ?></span>
            <?php endif ?>
        </div>
        
        <div class="boton_new" title="Crear Nuevo Estudiante">
            <a href="<?php echo url_for("Estudiante/new")?>" class="button rounded black" id="">
                 <?php echo image_tag('add.png', 'size=15x15') ?> Registrar Asistencia
            </a> 
            <a href="" class="button rounded black" id="pdf" title="Guardar actividades como PDF"  style="float: left;">
                <?php echo image_tag('document_save.png', 'size=15x15')?> Guardar como PDF 
            </a> 
        </div>
        
        <div style="clear: both;visibility: hidden"></div>
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead id="titulos">
                    <tr>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Tipo de Asistencia</td>
                        <td>Fecha</td>
                        <td>Acciones</td>
                    </tr>
                </thead>

                <tbody id="info">
                    
                    <?php
                    if(isset ($asistencias)){
                        foreach ($asistencias as $asist){
                            echo "<tr>";
                            echo "<td>".$asist->getUsuarioCurso()->getUsuario()->getNombre()."</td>";
                            echo "<td>".$asist->getUsuarioCurso()->getUsuario()->getApellido()."</td>";
                            echo "<td>".$asist->getTipoasistencia()->getNombre()."</td>";
                                echo "<td>".$asist->getFecha()."</td>";                                
                                
                                echo "<td>";
                                echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Estudiante/edit?id='.
                                        "", array('post=true','confirm' => 'Esta seguro que quiere Editar?','title'=>'Editar Estudiante'));
                                echo '&nbsp &nbsp' ;
                                echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Estudiante/delete?id='.
                                        "", array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Estudiante'));              
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
        
         <!-- Script para guardar las consultas en pdf -->
        <script type="text/javascript">
            $().ready(function() {

                //seteamos el evento click al boton, usamos un form oculto para enviar el requirimiento al servidor.
                $('#pdf').click(function(){
                var f = document.createElement('form');
                f.style.display = 'none';
                this.parentNode.appendChild(f);
                f.method = 'post';
                //colocamos el action que se va a invocar cuando se haga click
                f.action = '<?php echo url_for('Asistencia/guardarPdf',array('target'=>'_blank'))?>';
                //en la variable m se guarda el “html” de las secciones de la página que se van a guardar como pdf.      
                var m = document.createElement('input');
                var info_paralelo = $('#info_paralelo').html();
                var info_materia = $('#info_materia').html();
                var titulos = $('#titulos').html();
                var a1 = $('#info').html();
                var prueba = $('#prueba').html();
                m.setAttribute('type', 'hidden');
                m.setAttribute('name', 'html');
                m.setAttribute('value',prueba+info_paralelo+info_materia+'<table border="1">'+titulos+'<br/>'+a1+'</table>');
                f.appendChild(m);      
                f.submit();
                
                return false;
                });
              });
        </script> 
        
    </div>

</div>