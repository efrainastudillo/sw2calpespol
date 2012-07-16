<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <div class="titulo_login">
            <p>Login</p>    
        </div>
        <div class="form_login">
            <div class="form_centrado">
                <div  class="flash_notice">
                   <?php if ($sf_user->hasFlash('notice')): ?>
                      <div><?php echo $sf_user->getFlash('notice') ?></div>
                    <?php endif ?>
                </div>
                
                <form id="formulario" method="POST" action="login">
                    <div class="label"><label for="userID">Usuario:</label></div>
                    <div class="icono_error" id="i1" >*</div><div class="label"><input id="userID" name="userID" type="text" placeholder="Usuario Espol" /></div>
                    <div class="corrector"></div>
                    <div class="label"><label for="userPASS">Contrasenia:</label></div>
                    <div class="icono_error" id="i2" >*</div><div class="label"><input id="userPASS" name="userPASS" type="password" placeholder="Contrasenia Espol" /></div>
                    <div class="corrector" id="mensaje_error">mensaje oculto para errores</div>
                    <div class="corrector"></div>
                    <div style="float: right;width: 60px;text-align: center" class="button"><a style="width: 60px;" href="#">Login</a></div>
                </form>
            </div>
        </div>
    <div class="slogan">
            <p>Escuela Superior Politécnica del Litoral</p>
            <p>Copyright @ 2012</p>
        </div>

<a href="index">index</a>