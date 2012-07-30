<!-- Modulo Actividad, para crear la nueva Actividad -->
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
            <p>Registro de Actividad</p>
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
            <a href="<?php echo url_for("Actividad/index")?>" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Regresar a Lista de Actividades
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
                      <th>Tipo:</th>
                      <td><select name="tipo">
                              <?php //$usuario=$sf_user->getUserDB();
                                  //$par=Curso::getParalelosOfUsuarioByMateria($sf_user->getMateriaActual(),$usuario->getIdUsuario());
                                  foreach ($ta as $p){
                                    echo '<option value="'.$p->getIdtipoactividad().'">'.$p->getNombre().'</option>' ;
                                  }
                              ?>
                          </select>
                          <?php echo link_to(image_tag('/images/add.png', 'size=18x18'), 'Actividad/newtipoactividad'
                                  , array('post=true','confirm' => 'Esta seguro que quiere crear \n un nuevo Tipo de Actividad?','align'=>'top','title'=>'Crear Tipo de Actividad'));
                          ?>
                      </td>
                      <td>
                          
                      </td>
                  </tr>
                  <tr>
                      <th>Descipción:</th>
                      <td><input id="descripcion" name="descripcion" type="text" placeholder="Decripcion de la Actividad" value=""/></td>
                      <td><span id="req-descripcion" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Fecha de entrega:</th>
                      <td><input id="fecha" name="fecha" type="text"  value=""/></td>
                      <td><span id="req-fecha" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Nota:</th>
                      <td><input id="nota" name="nota" type="text" placeholder="Nota" value=""/></td>
                      <td><span id="req-nota" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                    <tr>
                      <td colspan="2">
                        <div id="grabar_actividad" class="boton_new">
                            <a href="#" class="button rounded black" >
                                <img src="../images/new.png" width="15" height="15" /> Grabar Actividad
                            </a>
                        </div>
                      </td>
                    </tr>
              </table>
            </form>
        </div>
        <div class="mensaje_ayuda"><p>Verifique que la Actividad que quiere Ingresar Corresponda al Paralelo y Materia Actual</p></div>
    </div> 
    
</div>
    