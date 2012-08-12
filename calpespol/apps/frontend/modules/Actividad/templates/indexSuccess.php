<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <div id="prueba"><?php echo "Actividades" ?></div>
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
        <div class="extra_head_panel" id="info_paralelo">
            <?php echo "<p>Paralelo: ".$sf_user->getParaleloActual()."</p>"; ?>
        </div>
        
        <div class="extra_head_panel" id="info_materia">
            <?php echo "<p>Materia: ".$sf_user->getMateriaActual()."</p>"; ?>
        </div>
    </div>
    <!-- Body para mostrar actividades -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <div class="boton_new" style="margin-right: 1em; ">

            <!-- Boton crear nueva actividad -->
            <a href="" class="button rounded black" id="pdf" title="Guardar actividades como PDF"  style="float: left;">
                <?php echo image_tag('document_save.png', 'size=15x15')?> Guardar como PDF 
            </a> 

            <?php if ($sf_user->hasFlash('actividad_grabada')): ?>
                <span style="margin-left: 50px;color: red;"><?php echo $sf_user->getFlash('actividad_grabada') ?></span>
            <?php endif ?>
                
            <!-- Boton para guardar en PDF -->
            <a href="<?php echo url_for("Actividad/newactividad")?>" class="button rounded black" id="new" title="Crear actividad" style="float: right;">
                <?php echo image_tag('add.png', 'size=15x15')?> Nueva Actividad 
            </a>
    <!--        <input class="" type="button" value="Guardar como PDF" id="pdf" >-->

            </div>
            
        </div>
        <div style="clear: both;visibility: hidden"></div>
        
        <table class="tabla" id="info">
            <thead id="titulos">
                <tr>
                    <td>&nbsp </td>
                    <td>Descripcion</td>
                    <td>Tipo de Actividad</td>
                    <td>Tipo de Realizacion</td>
                    <td>Valor Ponderacion</td>
                    <td>Fecha de Entrega</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui va la tabla que muestra todas las actividades -->
                <?php foreach ($a as $acti): ?>
                    <tr>
                        <!-- Flecha indicadora si esta visible o no los literales de una actividad -->
                        <td  class="actividad" style="padding: 0em;"> 
<!--                            <img src="./images/arrow-right-3.png">-->
                            <?php echo image_tag('arrow-right-3.png', array('size'=>'18x18','class'=>'flecha_literal','id'=>$acti->getIdActividad()))?> 
                        </td>
                        <!-- Nombre de la actividades -->
                        <td><?php echo $acti->getNombre(); ?></td>
                        <!-- Nombre del tipo de la actividad -->
                        <td><?php echo $acti->getTipoactividad()->getNombre(); ?></td>
                        <!-- Si es grupal o individual -->
                        <td><?php if ($acti->getTipoactividad()->getEsGrupal()) echo "Grupal"; else echo "Individual"; ?></td>
                        <!-- Valor del tipo actividad, ponderacion -->
                        <td><?php echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
                        <!-- Elimina el formato de hora y muestra el formato de fecha unicamente      -->
                        <?php $fecha = explode("-",str_replace('00:00:00', '', $acti->getFechaEntrega()));?>
                        <td><?php echo $fecha[0].'-'.$fecha[1].'-'.$fecha[2]?></td>
                        <td>
                            <?php echo link_to(image_tag('edit_2.png', 'size=18x18'), 'Actividad/edit?id='.
                                        $acti->getIdactividad(), array('post=true','confirm' => '¿Esta seguro que quiere Editar?','title'=>'Editar Actividad')); ?>&nbsp &nbsp
                            <?php echo link_to(image_tag('delete_2.png', 'size=18x18'), 'Actividad/delete?id='.
                                        $acti->getIdactividad(), array('post=true','method' => 'delete', 'confirm' => '¿Esta seguro que quiere Eliminar?','title'=>'Eliminar Actividad')); ?>&nbsp &nbsp
                            
                           <a href="javascript:void(0);" class="nuevo_literal" title="Nuevo Literal" id=<?php echo $acti->getIdActividad()?> ><?php echo image_tag('add.png', 'size=18x18')?></a>
                            
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
                    $('.tabla2').tableScroll({width:950, height:85, containerClass:'tabla_literal'});
                });
            </script>"
        ?>
        
        <!-- Script para guardar las consultas en pdf -->
        <script type="text/javascript">
            $().ready(function() {

                //seteamos el evento click al boton, usamos un form oculto para enviar el requirimiento al servidor.
                $('#pdf').click(function(){
                var f = document.createElement('form');
                f.style.display = 'none';
                this.parentNode.appendChild(f);
                f.method = 'post';
                //colocamos el action que se va a invocar cuando se haga click
                f.action = '<?php echo url_for('Actividad/guardarPdf',array('target'=>'_blank'))?>';
                //en la variable m se guarda el “html” de las secciones de la página que se van a guardar como pdf.      
                var m = document.createElement('input');
                var info_paralelo = $('#info_paralelo').html();
                var info_materia = $('#info_materia').html();
                var titulos = $('#titulos').html();
                var a1 = $('#info').html();
                var prueba = $('#prueba').html();
                m.setAttribute('type', 'hidden');
                m.setAttribute('name', 'html');
                m.setAttribute('value',prueba+info_paralelo+info_materia+'<table border="1">'+titulos+'<br/>'+a1+'</table>');
                f.appendChild(m);      
                f.submit();
                
                return false;
                });
              });
        </script> 

    </div>

</div>
    