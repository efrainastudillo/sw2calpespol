<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/inicio.png', 'alt_title=Inicio') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Inicio" ?>
<?php end_slot(); ?>

<?php slot('inicio-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <?php if ($sf_user->isAdmin()):?>
            <p>Sicronización</p>  
            <?php else:?>
            <p>Inicio</p>
            <?php endif;?>
        </div>
        
        <div class="extra_head_panel">
            <?php $sf_user->getMateriaActual();
                $sf_user->getParaleloActual();
            ?>
        </div>
        
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
           <?php if ($sf_user->hasFlash('mensaje')): ?>
              <div><?php echo $sf_user->getFlash('mensaje') ?></div>
            <?php endif ?>
        </div>
        <?php if ($sf_user->isAdmin()):?>
        <div id="sincronizar" class="boton_new">
            <a href="<?php echo url_for("Inicio/sincronizar")?>" class="button" >
                <img src="../images/new.png" width="15" height="15" />Iniciar Sincronización
            </a> 
        </div>
        <?php endif;?>
        
        
    </div>

</div>
 