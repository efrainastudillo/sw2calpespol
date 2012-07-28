<?php

/*
 * Modulo: Inicio
 * Accion: AdminLogin
 * @author Efrain Astudillo
 */
?>
    <div class="titulo_login">
        <p>Administrador Calpespol</p>    
    </div>
    <div style="float: right;width: 60px;text-align: center">
            <a style="width: 60px;" href="<?php echo url_for("Inicio/login")?>">
                <?php echo image_tag('/images/previus.png', array('alt_title'=>'Salir','class'=>'Salir','align'=>'top','size'=>'25x25')) ?>
            </a>
    </div>
    <div class="form_login">
        <div class="form_centrado">
            <div  class="flash_notice">
               <?php if ($sf_user->hasFlash('notice')): ?>
                  <div><?php echo $sf_user->getFlash('notice') ?></div>
                <?php endif ?>
            </div>

            <form id="formulario" method="POST" action="<?php echo url_for("Inicio/adminlogin")?>">
                <div class="label"><label for="userID">Usuario:</label></div>
                <div class="icono_error" id="i1" >*</div><div class="label"><input id="userID" name="userID" type="text" placeholder="Usuario Administrador" /></div>
                <div class="corrector"></div>
                <div class="label"><label for="userPASS">Contrasenia:</label></div>
                <div class="icono_error" id="i2" >*</div><div class="label"><input id="userPASS" name="userPASS" type="password" placeholder="Contrasenia Administrador" /></div>
                <div class="corrector" id="mensaje_error">mensaje oculto para errores</div>
                <div class="corrector"></div>
                <div id="login" style="float: right;width: 60px;text-align: center" class="button"><a style="width: 60px;" href="#">Login</a></div>
            </form>
        </div>
    </div>
    <div class="slogan">
        <p>Escuela Superior Politécnica del Litoral</p>
        <p>Copyright &copy; 2012</p>
    </div>
