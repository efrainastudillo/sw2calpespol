<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', array('alt_title'=>'Estudiantes','class'=>'hola')) ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Estudiantes" ?>
<?php end_slot(); ?>

<?php slot('estudiante-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Nuevo Estudiante</p>            
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
            <a href="<?php echo url_for("Estudiante/index")?>" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Regresar a Lista de Ayudantes
            </a>
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div>
            <form id="form_edit_estudiante" action="<?php echo url_for('Estudiante/create') ?>" method="POST">
              <table>
                  <tr style="display: none">
                      <th>Id:</th>
                      <td><input id="idu" name="id" type="text" placeholder="id" value=""/></td>
                  </tr>
                  <tr>
                      <th>Paralelo:</th>
                      <td><select name="paralelo">
                              <?php $usuario=$sf_user->getUserDB();
                                  $par=Curso::getParalelosOfUsuarioByMateria($sf_user->getMateriaActual(),$usuario->getIdUsuario());
                                  foreach ($par as $p){
                                    echo '<option value="'.$p->getParalelo().'">'.$p->getParalelo().'</option>' ;
                                  }
                              ?>
                          </select></td>
                      <td></td>
                  </tr>
                  <tr>
                      <th>Nombres:</th>
                      <td><input id="nombres" name="nombres" type="text" placeholder="Nombres" value=""/></td>
                      <td><span id="req-nombres" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Apellidos:</th>
                      <td><input id="apellidos" name="apellidos" type="text" placeholder="Apellidos" value=""/></td>
                      <td><span id="req-apellidos" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Usuario de Espol:</th>
                      <td><input id="user_espol" name="userespol" type="text" placeholder="Usuario de Espol" value=""/></td>
                      <td><span id="req-user_espol" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Correo:</th>
                      <td><input id="correo" name="correo" type="text" placeholder="Correo" value=""/></td>
                      <td><span id="req-correo" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Matrícula:</th>
                      <td><input id="matricula" name="matricula" type="text" maxlength="9" placeholder="Matricula" value=""/></td>
                      <td><span id="req-matricula" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Cédula:</th>
                      <td><input id="cedula" name="cedula" type="text" maxlength="10" placeholder="Cedula" value=""/></td>
                      <td><span id="req-cedula" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                <tr>
                  <td colspan="2">
                    <div id="update_user" class="boton_new">
                        <a href="#" class="button rounded black" >
                            <img src="../images/new.png" width="15" height="15" /> Grabar
                        </a>
                    </div>

                  </td>
                </tr>
              </table>
            </form>
        </div>
        <div class="mensaje_ayuda"><p>Verifique que el Estudiante que quiere Ingresar al Sistema Corresponda al Paralelo y Materia Actual</p></div>
    </div> 
    
</div>
    