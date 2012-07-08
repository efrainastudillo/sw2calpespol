<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    
      	<div id="div_contenedor_todo">
    	<div id="div_menu_sesion_usuario">
        
        </div>
    	<div id="div_menu_cabecera">
        	<div id="div_menu_cabecera_centrado">
            	<div id="div_logo_busqueda">
                	<div id="div_logo">Aqui va el logo esto se lo deberia manejar con Slot de Symfony, el color es solo de prueba</div>
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
                        <li class="green">
                            <p><a href="#">Inicio</a></p>
                            
                        </li>
                        <li class="yellow">
                            <p><a href="#">Materias</a></p>
                        </li>
                        <li class="red">
                            <p><a href="#">Ayudantías</a></p>
                        </li>
                        <li class="blue">
                            <p><a href="#">Estudiantes</a></p>
                        </li>
                        <li class="purple">
                            <p><a href="#">Actividades</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <li class="purple">
                            <p><a href="#">Asistencias</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                        <li class="purple">
                            <p><a href="#">Notas</a></p>
                            <!-- <p class="subtext">Legal things</p> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- esta linea es solo para el disenio #no modificar# -->
        <div id="div_linea_bajo_menu"></div>
        
        <div id="div_contenedor">
        	<div id="div_contenedor_info">
            	
            </div>
            <div id="div_contenedor_template">
            	<?php echo $sf_content ?>
            </div>
        </div>
    </div>
    <div id="footer"></div>
  </body>
</html>
