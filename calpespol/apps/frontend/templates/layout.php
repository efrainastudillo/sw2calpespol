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
    <link rel="shortcut icon" href="/eimages/estudiantes.png" type='image/png'/>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
      <div id="div_contenedor_todo">
    	<div id="div_menu_sesion_usuario">
            <div id="div_menu_sesion_usuario_centrado">
                <div class="div_sesion" style="text-align: right">
                    <ul>
                        <li>
                            <img src='../images/user2.png' width="23px" height="23px" align="top" />
                        </li>                        
                        <li>
                            <a href="#">
                                <?php echo $sf_user->getFullName()?>
                            </a>
                        </li>
                        <li>
                            <img src='../images/salir.png' width="23px" height="23px" align="top"/>
                        </li>
                        <li>
                            <a href="<?php echo url_for("Inicio/logout") ?>" > 
                                Salir
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="div_sesion">
                    <form method="POST" action="Inicio/change">
                        <label for="usuario" >Materia:</label>                        
                        <select id="materia_selecionada" style="width:200px;" name="lista_materias">
                          <option>Laboratorio de Potencia 1</option>
                          <option>Laboratorio de Potencia 2</option>
                          <option>Maquinarias</option>
                        </select>
                    </form>
                </div>
                <div class="div_sesion">
                    <form method="POST" action="Inicio/change">
                        <label for="usuario" >Parcial:</label>                        
                        <select id="parcial_selecionado" style="width:40px;" name="lista_parciales">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                        </select>
                    </form>
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
                        <li class="<?php if (!include_slot('ayudantia-css')): ?>deselected<?php endif; ?>" name="grupos">
                            <p><a href="#">Grupos</a></p>
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
