<!-- Modulo Actividad, para crear Tipo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
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
            <a href="<?php echo url_for("Actividad/index")?>" class="button" >
                <img src="../images/new.png" width="15" height="15" /> Crear Actividad
            </a>
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div>
            <form id="form_new_actividad" action="<?php echo url_for('Actividad/create') ?>" method="POST">
              <table>
                  <tr style="display: none">
                      <th>Id:</th>
                      <td><input id="idu" name="id" type="text" placeholder="id" value=""/></td>
                  </tr>
                  <tr>
                      <th>Nombre del Tipo de Actividad:</th>
                      <td><input id="nombre" name="nombre" type="text" placeholder="Decripcion de la Actividad" value=""/></td>
                      <td><span id="req-nombre" class="requisites">Tiene deshabilitado Javascript</span></td>                      
                  </tr>
                  <tr>
                      <th>Realización:</th>
                      <td>
                          <select name="tipo_realizacion">
                              <option value="Individual">Individual</option>
                              <option value="Grupal">Grupal</option>
                          </select>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Tipo:</th>
                      <td>
                          <select name="tipo_actividad">
                              <option value="Ordinaria">Ordinaria</option>
                              <option value="Extraordinaria">Extraordinaria</option>
                          </select>
                      </td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Parcial:</th>
                      <td><select name="parcial">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                          </select></td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Ponderación:</th>
                      <td><input id="ponderacion" name="ponderacion" type="text" placeholder="Nota" value=""/></td>
                      <td><span id="req-ponderacion" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                    <tr>
                      <td colspan="2">
                        <div id="grabar_actividad" class="boton_new">
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
    