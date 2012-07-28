<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
 /**
  * 
  * @author Efrain Astudillo
  */
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php echo stylesheet_tag('favicon.png',array('type'=>'image/png','rel'=>'shortcut icon')) ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <?php $materias = $sf_user->getMaterias(); $paralelos=$sf_user->getParalelos();?>
  </head>
  <body>
      
      <div id="div_contenedor_todo">
    	<div id="div_menu_sesion_usuario">
            <div id="div_menu_sesion_usuario_centrado">
                <div class="div_sesion" style="text-align: right">
                    <ul>
                        <li>
                            <?php echo image_tag('/images/user2.png', array('alt_title'=>'User','class'=>'UserImage','align'=>'top','size'=>'23x23')) ?>                           
                        </li>                        
                        <li>
                            <a href="#">                                
                                <?php if($sf_user->isAdmin()){
                                        echo "Administrador";
                                    }else{
                                        echo $sf_user->getFullName();
                                    }
                                ?>
                            </a>
                        </li>
                        <li>
                            <?php echo image_tag('/images/salir.png', array('alt_title'=>'Salir','class'=>'Salir','align'=>'top','size'=>'23x23')) ?>
                        </li>
                        <li>
                            <a href="<?php echo url_for("Inicio/logout") ?>" >
                                Salir
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="div_sesion">
                    <?php if(!$sf_user->isAdmin()):?>
                    <form id="form_materias" method="POST" action="<?php echo url_for("Inicio/materia");?>">
                        <label for="usuario" >Materia:</label>                    
                        <select id="materia_selecionada" style="width:200px;" name="lista_materias">
                            <?php
                            if(isset ($materias)){
                                $temp=$sf_user->getMateriaActual();
                                foreach ($materias as $value) {
                                    if(strcasecmp($value->getNombre(), $temp)==0){
                                        echo "<option selected='selected' value='".$value->getNombre()."' >".$value->getNombre()."</option>";
                                    }else{
                                        if(strcasecmp($temp, "")==0){
                                            $sf_user->setMateriaActual($value->getNombre());
                                        }
                                        echo "<option  value='".$value->getNombre()."' >".$value->getNombre()."</option>";
                                    }
                                }
                            }?>
                            <input name="modulo" type="text" value="<?php echo $sf_context->getModuleName() ?>" style="display: none" />
                            <input name="accion" type="text" value="<?php echo $sf_context->getActionName() ?>" style="display: none" />
                        </select>
                    </form>
                    <?php endif;?>
                </div>
                <div class="div_sesion">
                    <?php if(!$sf_user->isAdmin()):?>
                    <form method="POST" action="Inicio/change">
                        <label for="usuario" >Paralelo:</label>
                        <select id="paralelo_selecionado" style="width:40px;" name="lista_paralelos">
                          <?php
                            if(isset ($paralelos)){
                                $temp=$sf_user->getParaleloActual();
                                foreach ($paralelos as $value) {
                                    if(strcasecmp($value->getParalelo(), $sf_user->getParaleloActual())==0){
                                        echo "<option selected='selected' value='".$value->getParalelo()."' >".$value->getParalelo()."</option>";
                                    }else{
                                        if(strcasecmp($temp, "")==0){
                                            $sf_user->setParaleloActual($value->getParalelo());
                                        }
                                        echo "<option  value='".$value->getParalelo()."' >".$value->getParalelo()."</option>";
                                    }
                                }                                
                            }?>
                            <input name="modulo" type="text" value="<?php echo $sf_context->getModuleName() ?>" style="display: none" />
                            <input name="accion" type="text" value="<?php echo $sf_context->getActionName() ?>" style="display: none" />
                        </select>
                    </form>
                    <?php endif;?>
                </div>
                <div class="div_corrector_float"></div>
            </div>
        </div>
    	<div id="div_menu_cabecera">
        	<div id="div_menu_cabecera_centrado">
            	<div id="div_logo_busqueda">
                	<div id="div_logo">
                    	<div id="div_logo_image"><?php include_slot('logo') ?></div>
                        <div id="div_logo_nombre"><h1><?php include_slot('title') ?></h1></div>
                    </div>
                    <div id="div_busqueda">
                    	<form>
                            <input type="text"  placeholder="Busqueda" />
                            <input type="button" value="BUS"/>
                        </form>
                    </div>
                    <div class="div_corrector_float"></div>
                </div>
                
                <!-- Menu Principal-->
                <div id="div_menu_principal">
                	<ul>
                        <li class="<?php if (!include_slot('inicio-css')): ?>deselected<?php endif; ?>" name="inicio">
                            <p><a href="<?php echo url_for('Inicio/index') ?>">Inicio</a></p>
                            
                        </li>
                        <li class="<?php if (!include_slot('materia-css')): ?>deselected<?php endif; ?>" name="materias">
                            <p><a href="#">Materias</a></p>
                        </li>
                        <?php if(!$sf_user->isAdmin()):?>
                        <li class="<?php if (!include_slot('ayudantia-css')): ?>deselected<?php endif; ?>" name="grupos">
                            <p><a href="<?php echo url_for('Grupo/index') ?>">Grupos</a></p>
                        </li>
                         
                        <li class="<?php if (!include_slot('estudiante-css')): ?>deselected<?php endif; ?>" name="estudiantes">
                            <p><a href="<?php echo url_for('Estudiante/index') ?>">Estudiantes</a></p>
                        </li>
                        
                        <li class="<?php if (!include_slot('actividad-css')): ?>deselected<?php endif; ?>" name="actividades">
                            <p><a href="<?php echo url_for('Actividad/index') ?>">Actividades</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <li class="<?php if (!include_slot('asistencia-css')): ?>deselected<?php endif; ?>" name="asistencias">
                            <p><a href="<?php echo url_for('Asistencia/index') ?>">Asistencias</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <li class="<?php if (!include_slot('nota-css')): ?>deselected<?php endif; ?>" name="notas">
                            <p><a href="<?php echo url_for('Nota/index') ?>">Notas</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <li class="<?php if (!include_slot('ayudante-css')): ?>deselected<?php endif; ?>" name="ayudantes">
                            <p><a href="<?php echo url_for('Ayudante/index') ?>">Ayudantes</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <?php endif;?>
                        <?php if($sf_user->isAdmin()):?>
                        <li class="<?php if (!include_slot('profesor-css')): ?>deselected<?php endif; ?>" name="profesores">
                            <p><a href="<?php echo url_for('Profesor/index') ?>">Profesores</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- esta linea es solo para el disenio #no modificar# -->
        <div id="div_linea_bajo_menu"></div>
        
        <div id="div_contenedor">
<!--            <div id="div_contenedor_info">
                  <div id="flash_notice"></div>
            </div>-->
            <div id="div_contenedor_template">
            	<?php echo $sf_content ?>
            </div>
        </div>
    </div>
    <div id="footer"></div>
  </body>
</html>
