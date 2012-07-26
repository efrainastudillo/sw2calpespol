<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', 'alt_title=Estudiantes') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Estudiantes" ?>
<?php end_slot(); ?>

<?php slot('estudiante-css') ?>
    <?php echo "selected" ?>
<?php end_slot();?>

<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Actualización de Estudiante</p>            
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
            <p>  </p>
        </div>
        
        <div id="regresar_lista" class="boton_new">
            <a href="<?php echo url_for("Estudiante/index")?>" class="button rounded black" >
                <img src="../images/new.png" width="15" height="15" /> Regresar a Lista de Estudiantes
            </a>
        </div>
        <div>
            <form id="form_edit_estudiante" action="<?php echo url_for('Estudiante/update') ?>" method="POST">
              <table>
                  <tr style="display: none">
                      <th>Id:</th>
                      <td><input id="idu" name="id" type="text" placeholder="id" value="<?php echo $estudiante->getIdUsuario()?>"/></td>
                  </tr>
                  <tr>
                      <th>Nombres:</th>
                      <td><input id="nombres" name="nombres" type="text" placeholder="Nombres" value="<?php echo $estudiante->getNombre()?>"/></td>
                      <td><span id="req-nombres" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Apellidos:</th>
                      <td><input id="apellidos" name="apellidos" type="text" placeholder="Apellidos" value="<?php echo $estudiante->getApellido()?>"/></td>
                      <td><span id="req-apellidos" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Usuario de Espol:</th>
                      <td><input id="user_espol" name="userespol" type="text" placeholder="Usuario de Espol" value="<?php echo $estudiante->getUsuarioEspol()?>"/></td>
                      <td><span id="req-user_espol" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Correo:</th>
                      <td><input id="correo" name="correo" type="text" placeholder="Correo" value="<?php echo $estudiante->getMail()?>"/></td>
                      <td><span id="req-correo" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Matrícula:</th>
                      <td><input id="matricula" name="matricula" type="text" maxlength="9" placeholder="Matricula" value="<?php echo $estudiante->getMatricula()?>"/></td>
                      <td><span id="req-matricula" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                  <tr>
                      <th>Cédula:</th>
                      <td><input id="cedula" name="cedula" type="text" maxlength="10" placeholder="Cedula" value="<?php echo $estudiante->getCedula()?>"/></td>
                      <td><span id="req-cedula" class="requisites">Tiene deshabilitado Javascript</span></td>
                  </tr>
                <tr>
                  <td colspan="2">
                    <div id="update_user" class="boton_new">
                        <a href="#" class="button rounded black" >
                            <img src="../images/new.png" width="15" height="15" /> Actualizar
                        </a>
                    </div>

                  </td>
                </tr>
              </table>
            </form>
        </div>
    </div> 
</div>
    




