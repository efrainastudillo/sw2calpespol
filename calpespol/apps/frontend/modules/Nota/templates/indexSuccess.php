<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/notas.png', 'alt_title=Notas') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Notas" ?>
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
            <div class="extra_head_panel">
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
        </div>

<!--        <div class="boton_new" style="float:left;">
            <a href="<?php //echo url_for("Actividad/newactividad")?>" class="button rounded black" id="new" title="Crear actividad" style="float: right;">
                <?php //echo image_tag('add.png', 'size=15x15')?> Cargar información
            </a>
        </div>-->
        
        <div class="tableScroll">
            <table class="tabla" cellspacing="0">
                <thead>
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
                                foreach ($literal as $lit) {
                                    echo "<td>" . "Literal ". $i++ ." (" .$lit-> getValorPonderacion().")"  . "</td>";
                                }
                            }
                        ?>
                        <td>Total</td> 
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui va la tabla que muestra todas las actividades-->
                    <?php
                        if ($esgrupal[0]->getEsGrupal()) {
                            if (isset($usuario)) {
                                foreach ($usuario as $us) {
                                    echo "<tr>";
                                    echo "<td>" . $us->getNombre() . " ". $us->getApellido() . "</td>";
                                    if (isset($literal)) {
                                        foreach ($literal as $lit) {
                                            echo "<td><input type='text' placeholder='nota' size='3' maxlength='3' style='text-align:right'></td>";
                                        }

                                    }
                                    echo "<td>10</td>";
                                    echo "</tr>";
                                }
                           }
                        }
                        if ($esgrupal[0]->getEsGrupal()) {
                            if (isset($grupos)) {
                                foreach ($grupos as $g) {
                                    echo "<tr>";
                                    echo "<td>" . $g->getNombre()." ". $us->getApellido() .  "</td>";
                                    if (isset($literal)) {
                                        foreach ($literal as $lit) {
                                            echo "<td><input type='text' placeholder='nota' size='3' maxlength='3' style='text-align:right'></td>";
                                        }
                                    }
                                    echo "<td>10</td>";
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
                <thead>
                    <tr>
                        <td>Literales</td>
                        <td>Descripción</td>
                    </tr>
                </thead>
                <tbody>
                     <?php 
                        if(isset ($literal)){
                            $i=1;
                            foreach ($literal as $lit){
                                echo "<tr>";
                                    echo "<td>" . "Literal ". $i++ ." (" . $lit->getValorPonderacion() . ")" . "</td>";
                                    echo "<td>".$lit->getNombreLiteral()."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>    
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