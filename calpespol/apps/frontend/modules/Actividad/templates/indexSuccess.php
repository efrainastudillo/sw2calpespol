<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_javascript("actividad.js")?>
<?php use_javascript("popup_nuevo_literal.js")?>
<?php use_stylesheet("modulo/actividad/actividad.css")?>

<div class="panel">
    <div class="head_panel">
        <div class="titulo_head_panel">
            <p>Consulta de Actividad</p>
        </div>
        <div class="extra_head_panel">
            <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
    </div>
    <!-- Body para mostrar actividades -->
    <div class="body_panel">
        <div class="titulo_body_panel">
        <div class="boton_new" style="margin-right: 1em; ">
            <a href="<?php echo url_for("Actividad/NewView")?>" class="button rounded black" id="new" title="Crear actividad">
                <img src="/images/new.png" width="15" height="15" /> Nueva Actividad
            </a> 
        </div>
        
        <div style="clear: both;visibility: hidden"></div>
        
        <table class="tabla">
            <thead>
                <tr>
                    <td>&nbsp </td>
                    <td>Descripcion</td>
                    <td>Tipo de Actividad</td>
                    <td>Tipo de Realizacion</td>
                    <td>Valor Ponderacion</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui va la tabla que muestra todas las actividades -->
                <?php foreach ($a as $acti): ?>
                    <tr>
                        <!-- Flecha indicadora si esta visible o no los literales de una actividad -->
                        <td  class="actividad" style="padding: 0em;"><img src="../images/arrow-right-3.png" class="flecha_literal" id=<?php echo $acti->getIdActividad()?> /></td>
                        <!-- Nombre de la actividades -->
                        <td><?php echo $acti->getNombre(); ?></td>
                        <!-- Nombre del tipo de la actividad -->
                        <td><?php echo $acti->getTipoactividad()->getNombre(); ?></td>
                        <!-- Si es grupal o individual -->
                        <td><?php if ($acti->getTipoactividad()->getEsGrupal()) echo "Grupal"; else echo "Individual"; ?></td>
                        <!-- Valor del tipo actividad, ponderacion -->
                        <td><?php echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
                        <td>
                            <?php echo link_to(image_tag('/images/edit_2.png', 'size=18x18'), 'Actividad/edit?id='.
                                        $acti->getIdactividad(), array('post=true','confirm' => '¿Esta seguro que quiere Editar?','title'=>'Editar Actividad')); ?>&nbsp &nbsp
                            <?php echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Actividad/delete?id='.
                                        $acti->getIdactividad(), array('post=true','method' => 'delete', 'confirm' => '¿Esta seguro que quiere Eliminar?','title'=>'Eliminar Actividad')); ?>&nbsp &nbsp
                            <a href="javascript:void(0);" class="nuevo_literal" id=<?php echo $acti->getIdActividad()?> ><img src="../images/add.png" width="18" height="18" title="Nuevo Literal" /></a>

                        </td>
                    </tr>  
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Aquí van las tablas que muestran los literales de cada actividad -->
        <?php foreach($a as $acti): ?>
            <?php $total = 0;?> 
            <div>
                <table class="tabla2 <?php echo $acti->getIdActividad()?>">
                    
                    <thead style="background-color: #d7d78c;">
                        <tr>
                            <td>Descripción del literal</td>
                            <td>Valor</td>
                            <td>Acción</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach($l = Literal::getLiteralesXActividad($acti->getIdActividad()) as $lit): ?>
                        <tr>
                            <td><?php echo $lit->getNombreLiteral();?></td>
                            <td><?php echo $lit->getValorPonderacion();?></td>
                            <td>
                                <?php echo link_to(image_tag('/images/delete_2.png', 'size=18x18'), 'Actividad/DeleteLiteral?id='.
                                        $lit->getIdLiteral(), array('post=true','method' => 'delete', 'confirm' => 'Esta seguro que quiere Eliminar?','title'=>'Eliminar Literal')); ?>             
                            </td>
                        </tr>
                        <?php $total = $total + $lit->getValorPonderacion();?>
                        <?php endforeach;?>
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td id="estilo1_celda">TOTAL</td>
                            <td id="estilo2_celda"><?php echo $total;?></td>
                            <td></td>
                        </tr>
                    </tfoot>    
                </table>
                
            </div>

        <?php endforeach;?>  

        <?php echo 
            "<script>
                jQuery(document).ready(function($)
                {
                    $('.tabla').tableScroll({width:950, height:170, containerClass:'tabla_actividad'});
                    $('.tabla2').tableScroll({width:950, height:100, containerClass:'tabla_literal'});
                });
            </script>"
        ?>

    </div>
</div>