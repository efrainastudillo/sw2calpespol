<?php 
    /*
     * Autor:       Efrain Astudillo
     * Descripcion: muestra la lista de asistencias de los estudiantes
     * Modulo:      Asistencia
     * Fecha:       8 de Agosto de 2012
     */
    slot('logo'); 
        echo image_tag('/images/asistencias.png', 'alt_title=Asistencias') ;
    end_slot();
    slot('title') ;
        echo "Asistencia" ;
    end_slot(); 
    slot('asistencia-css') ;
        echo "selected";
    end_slot();

 ?>
<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Consulta de Asistencias</p>  
            
        </div>
        
        <div class="extra_head_panel" id="info_paralelo">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div class="extra_head_panel" id="info_materia">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <h4 id="info_fecha">Fecha de Asistencia: <?php $fecha= date("d-F-Y"); echo $fecha; ?></h4>
           <?php if ($sf_user->hasFlash('graba_asistencia')): ?>
              <span style="margin-left: 50px;color: red;"><?php echo $sf_user->getFlash('graba_asistencia') ?></span>
            <?php endif ?>
        </div>
        
        <div class="boton_new" title="Grabar Asistencia">
            <a href="" class="button rounded black" id="pdf" title="Guardar actividades como PDF"  style="float: left;">
                <?php echo image_tag('document_save.png', 'size=15x15')?> Guardar como PDF 
            </a>  
        </div>
        <div class="boton_new" title="Volver Asistencia">
            <a href="<?php echo url_for("Asistencia/index")?>" class="button rounded black" id="">
                 <?php echo image_tag('back.png', 'size=15x15') ?> Volver a Asistencias
            </a> 
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead id="titulos">
                    <tr>
                        <td>Id</td>
                        <td>Nombres</td>                        
                        <td>Asistencia</td>                      
                    </tr>
                </thead>
                <tbody id="info">     
                    
                    <?php
                    $sf_user->getMateriaActual();
                    if(isset ($estudiantes)){
                        foreach ($estudiantes as $est){
                            echo "<tr>";
                            echo "<td>".$est->getIdUsuario()."</td>";
                            echo "<td>".$est->getNombre()." ".$est->getApellido()."</td>";
                            //echo "<td>".$est->getApellido()."</td>";
                            echo "
                                <td>
                                    <select name='asistencia'>
                                        <option value='Presente'>Presente</option>
                                        <option value='Ausente'>Ausente</option>
                                    </select>
                                </td>";
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
                $('.tabla').tableScroll({width:950, height:330});

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
                var info_fecha = $('#info_fecha').html();
                m.setAttribute('type', 'hidden');
                m.setAttribute('name', 'html');
                m.setAttribute('value',info_paralelo+info_materia+info_fecha+'<table border="1">'+titulos+'<br/>'+a1+'</table>');
                f.appendChild(m);      
                f.submit();
                
                return false;
                });
              });
        </script> 
        
    </div>

</div>