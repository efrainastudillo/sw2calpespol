<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/notas.png', 'alt_title=Notas') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <div id="prueba"><?php echo "Notas" ?></div>
<?php end_slot(); ?>

<?php slot('nota-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_stylesheet('/css/modulo/nota/nota.css');?>
<?php use_javascript('/js/nota.js')?>

<div class="panel">
    <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Ingreso de Notas</p>
            </div>
            <div id="info_materia" class="extra_head_panel">
               <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
            </div>
    </div>
    <!--Body para mostrar actividades    -->
    
    
    
    <div class="body_panel">
        <div class="titulo_body_panel">

            <div class="titulo_head_panel" id="tipo_actividad">
                
                <form id="form_tipos" method="POST" action="<?php echo url_for("Nota/Tiposactividad");?>">
                    <label for="tipo_seleccionado" >Tipos de Actividad: </label>                    
                    <select id="tipo_seleccionado" style="width:200px;" name="lista_tipos">
                        <?php
                        if(isset ($tipo_actividad)){
                            foreach ($tipo_actividad as $tipo) {
                                if($tipo->getNombre()==$sf_user->getTipoActividadActual()){
                                    echo "<option  selected='selected' value='".$tipo->getNombre()."' >".$tipo->getNombre()."</option>";
                                        
                                }else{
                                    if(strcasecmp($sf_user->getTipoActividadActual(), "")==0){
                                        $sf_user->setTipoActividadActual($tipo->getNombre());                                         
                                    }
                                    echo "<option value='".$tipo->getNombre()."' >".$tipo->getNombre()."</option>";
                                    
                                }
                            }
                            
                        }?>
                        
                        <input name="modulo" type="text" value="<?php echo $sf_context->getModuleName() ?>" style="display: none" />
                        <input name="accion" type="text" value="<?php echo $sf_context->getActionName() ?>" style="display: none" />
                    </select>
                </form>
                
            </div>         
            
            <div class="extra_head_panel" id="actividad" style="float:left;">
                <form id="form_actividad" method="POST" action="<?php echo url_for("Nota/actividad");?>">
                    <label for="actividad_seleccionada" >Actividad: </label>                    
                    <select id="actividad_seleccionada" style="width:200px;" name="lista_actividades">
                        <?php
                        if(isset ($actividad)){
                            foreach ($actividad as $acti) {
                                if($acti->getNombre()==$sf_user->getActividadActual()){
                                    echo "<option  selected='selected' value='".$acti->getNombre()."' >".$acti->getNombre()."</option>";
                                        
                                }else{
                                    if(strcasecmp($sf_user->getActividadActual(), "")==0){
                                        $sf_user->setActividadActual($acti->getNombre());                                         
                                    }
                                    echo "<option value='".$acti->getNombre()."' >".$acti->getNombre()."</option>";
                                    
                                }
                            }
                        }?>
                        <input name="modulo" type="text" value="<?php echo $sf_context->getModuleName() ?>" style="display: none" />
                        <input name="accion" type="text" value="<?php echo $sf_context->getActionName() ?>" style="display: none" />
                    </select>
                     
                </form>
                
            </div>
            <!-- Boton crear nueva actividad -->
                <a href="" class="button rounded black"s id="pdf" title="Guardar actividades como PDF" style="margin-left:7em">
                    <?php echo image_tag('document_save.png', 'size=15x15')?> Guardar como PDF 
                </a>   
        </div>
        
        <div class="tableScroll">
            <table class="tabla" cellspacing="0">
                <thead id="titulos2">
                    <tr> 
                        <?php          
                            if ($esgrupal[0]->getEsGrupal()) {
                                echo "<td>" . "Grupos" . "</td>";
                            } else {
                                echo "<td>" . "Estudiantes" . "</td>";
                            }
                        ?>
                        <?php
                            if (isset($literal)) {
                                $i=1;
                                $total = 0;
                                foreach ($literal as $lit) {
                                    echo "<td>" . "Literal ". $i++ ." (" .$lit-> getValorPonderacion().")"  . "</td>";
                                    $total = $total + $lit->getValorPonderacion() ;
                                    
                                }
                            }
                        ?>
                        <td>Total(<?php echo $total?>)</td> 
                    </tr>
                </thead>
                <tbody id="estudiante">
                    <!--Aqui va la tabla que muestra todas las actividades-->
                    <?php
                        if ($esgrupal[0]->getEsGrupal()) {
                            if (isset($grupos)) {
                                foreach ($grupos as $g) {
                                    echo "<tr>";
                                    echo "<td class='grupo_estudiante'>" . $g->getNombre()." ". $us->getApellido() .  "</td>";
                                    if (isset($literal)) {
                                        foreach ($literal as $lit) {
                                            echo "<td><input type='text' class='nota_literal_grupo' id='".$lit->getIdliteral()."' placeholder='nota' size='3' maxlength='3' style='text-align:right'>
                                                      <input type='hidden' name='valor_literal_grupo' value='".$lit->getValorPonderacion()."'>  
                                                  </td>";
                                            
                                            
                                        }
                                    }
                                    echo "<td>"."0"."</td>";
                                    echo "</tr>";
                                }
                            }
                        }else{
                            
                            if (isset($usuario)) {
                                foreach ($usuario as $us) {
                                    echo "<tr>";
                                    echo "<td class='estudiante'>" . $us->getNombre() . " ". $us->getApellido() . "</td>";
                                    if (isset($literal)) {
                                        foreach ($literal as $lit) {
                                            echo "<td><input type='text' name='nota_literal' class='nota_literal' id='".$lit->getIdliteral()."' placeholder='nota' size='3' maxlength='3' style='text-align:right'>
                                                      <input type='hidden' name='valor_literal' value='".$lit->getValorPonderacion()."'>  
                                                  </td>";
                                        }
                                    }
                                    echo "<td>"."0"."</td>";
                                    echo "</tr>";
                                }
                           }
                            
                        }
                            
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
    
    <div class="tableScroll" style="margin-top: 1em">
            <table class="tabla" cellspacing="0">
                <thead id="titulos">
                    <tr>
                        <td>Literales</td>
                        <td>Descripción</td>
                    </tr>
                </thead>
                <tbody id="info">
                     <?php 
                        if(isset ($literal)){
                            $i=1;
                            foreach ($literal as $lit){
                                echo "<tr>";
                                    echo "<td>" . "Literal ". $i++ ." (" . $lit->getValorPonderacion() . ")" . "</td>";
                                    echo "<td>".$lit->getNombre_literal()."</td>";
                                echo "</tr>";
                               
                            }
                        }
                    ?>
                </tbody>    
            </table>
        </div>
        <!-- Boton para guardar las notas -->
        <a href="<?php echo url_for('Nota/guardarNota',array('target'=>'_blank'))?>" class="button rounded black" id="guardar_notas" title="Guardar Notas"  style="margin: 1em; margin-left: 34em">
            <?php echo image_tag('save.png', 'size=15x15')?> Guardar Notas
        </a>
    
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
                    f.action = '<?php echo url_for('Nota/guardarPdf',array('target'=>'_blank'))?>';
                    //en la variable m se guarda el “html” de las secciones de la página que se van a guardar como pdf.      
                    var m = document.createElement('input');
                    var info_paralelo = $('#info_paralelo').html();
                    var info_materia = $('#info_materia').html();
                    var titulos = $('#titulos').html();
                    var titulos2 = $('#titulos2').html();
                    var estudiante = $('#estudiante').html();
                    var a1 = $('#info').html();
                    var prueba = $('#prueba').html();
                    m.setAttribute('type', 'hidden');
                    m.setAttribute('name', 'html');
                    m.setAttribute('value',prueba+info_materia+'<table border="1">'+titulos2+'<br/>'+estudiante+'<br/>'+'</table>'+'<table border="1">'+titulos+'<br/>'+a1+'</table>');
                    f.appendChild(m);      
                    f.submit();

                    return false;
                });
                
              });
        </script> 
</div>