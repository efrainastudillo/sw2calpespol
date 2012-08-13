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
        
        <div class="extra_head_panel">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div class="extra_head_panel">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <h4>Fecha de Asistencia: <?php $fecha= date("d-F-Y"); echo $fecha; ?></h4>
           <?php if ($sf_user->hasFlash('graba_asistencia')): ?>
              <span style="margin-left: 50px;color: red;"><?php echo $sf_user->getFlash('graba_asistencia') ?></span>
            <?php endif ?>
        </div>
        
        <div class="boton_new" title="Grabar Asistencia">
            <a href="<?php echo url_for("Asistencia/newasistencia")?>" class="button" id="">
                 <?php echo image_tag('save.png', 'size=15x15') ?> Grabar
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

                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombres</td>                        
                        <td>Asistencia</td>                      
                    </tr>
                </thead>
                <tbody>     
                    
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
        
    </div>

</div>