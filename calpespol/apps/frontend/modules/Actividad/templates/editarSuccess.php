<? php 
/*
 * Autor:       Andrea Cáceres y Jefferon Rubio
 * Descripcion: Registra los nuevo tipos de actividades
 * Modulo:      Actividad
 * Fecha:       8 de Agosto de 2012
 */?>
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_javascript('tipoactividad.js') ?>
<?php use_stylesheet("modulo/actividad/actividad.css")?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Registro de Tipo de Actividad</p>
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
            <div style="margin-right:200px;color: red;"  class="extra_head_panel">
               <?php if ($sf_user->hasFlash('mensaje')): ?>
                  <div><?php echo $sf_user->getFlash('mensaje') ?></div>
                <?php endif ?>
            </div>
        </div>
        
        <div id="regresar_lista" class="boton_new">
            <a href="<?php echo url_for("Actividad/index")?>" class="button" >
                <img src="../images/new.png" width="15" height="15" /> Regresar a Lista de Actividades
            </a>
        </div>
        <div id="crear_actividad" class="boton_new">
            <a href="<?php echo url_for("Actividad/newactividad")?>" class="button" >
                <img src="../images/new.png" width="15" height="15" /> Crear Actividad
            </a>
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div>
            <form id="formulario" action="<?php echo url_for('Actividad/actualizartipo') ?>" method="POST">
              <table>
                  <tr style="display: none">
                      <th>Id:</th>
                      <td><input id="idu" name="id" type="text" placeholder="id" value="<?php echo $actividad->getIdTipoActividad()?>"/></td>
                  </tr>
                  <tr>
                      <th>Nombre del Tipo de Actividad:</th>
                      <td><input id="nombre" name="nombre" type="text" placeholder="Descripcion del Tipo Actividad" value="<?php echo $actividad->getTipoactividad()->getNombre()?>"/></td>
                      <td><span id="req-nombre" class="requisites">Tiene deshabilitado Javascript</span></td>                      
                  </tr>
                  <tr>
                      <th>Realización:</th>
                      <td>
                          <select id="realizacion" name="tipo_realizacion">
                              <option value="Individual">Individual</option>
                              <option value="Grupal">Grupal</option>
                          </select>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Tipo:</th>
                      <td>
                          <select id="tipo" name="tipo_actividad">
                              <option value="Ordinaria">Ordinaria</option>
                              <option value="Extraordinaria">Extraordinaria</option>
                          </select>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Parcial:</th>
                      <td><select id="parcial" name="parcial">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                          </select></td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Ponderación:</th>
                      <td><input id="ponderacion" name="ponderacion" type="text" placeholder="Ponderacion" value="<?php echo $actividad->getTipoactividad()->getValorPonderacion()?>"/></td>
                      <td><span id="req-ponderacion" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                    <tr>
                      <td colspan="2">
                        <div id="grabar_tipo_actividad" class="boton_new">
                            <a href="#" class="button rounded black" >
                                <img src="../images/new.png" width="15" height="15" /> Guardar
                            </a>
                        </div>
                      </td>
                    </tr>
              </table>
            </form>
        </div>
        <div class="mensaje_ayuda"><p>Verifique que el Tipo de Actividad que quiere Ingresar Corresponda al Paralelo y Materia Actual</p></div>
    </div> 
    
</div>
    