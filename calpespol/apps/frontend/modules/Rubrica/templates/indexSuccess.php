<!--
    Document   : index - Rubrica
    Created on : May 20, 2012
    Author     : Jefferson Rubio Angulo
    Description:
        Página inicial del módulo rúbrica, donde se administra los literales y 
        puntajes de estos que tiene cada actividad en el sistema.
-->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Rubrica') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Rúbrica de actividad" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php use_javascript('rubrica.js') ?>

<?php 
    $total = 0;
?>

<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p><?php echo $categoria[0]->getNombre(); ?></p>    
        </div>
        
        <div class="extra_head_panel">
            <p> <?php echo 'nota '.$tipo_categoria[0]->getNombre(); ?> </p>
            
            <?php if($tipo_calificacion[0]->getNombre()=="Individual"): ?>
                <img src='../images/a_individual.png' title='Actividad individual'>
            <?php else: ?>
                <img src='../images/a_grupal.png' title='Actividad grupal'>
            <?php endif; ?>      
        </div>
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <p> TEMA: </p>
            <p> <?php echo $actividad[0]->getNombre(); ?> </p>  
        </div>
        
        <div class="boton_new">
            <a href="javascript:void(0);" class="button rounded black" id="new">
                <span><img src="../images/new.png" />&nbsp</span>Nuevo literal
            </a> 
        </div>
        
        <div class="tableScroll">
            
            <table class="tabla" cellspacing="0">

                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Detalle</td>
                        <td>Puntaje</td>
                        <td>Acción</td>	
                    </tr>
                </thead>

                <tbody>
                    <?php if($items[0]->getNombre()!=""): ?>
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo $item->getLiteral() ?></td>
                            <td><?php echo $item->getNombre() ?></td>
                            <td><?php echo $item->getValorMax() ?></td>
                            <td><?php echo "<img src='../images/edit.png'> 
                                                    &nbsp &nbsp 
                                            <img src='../images/delete.png'>"?>
                            </td>
                        </tr>
                        <?php $total = $total+$item->getValorMax()?>
                        <?php endforeach; ?>  
                    <?php else: ?>
                        <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        </tr> 
                    <?php endif; ?>     
                </tbody>

                <tfoot>
                    <tr>
                        <td>&nbsp;</td>
                        <td id="estilo1_celda">TOTAL</td>
                        <td class="total" id="estilo2_celda"><?php echo $total?></td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
                
            </table>
            
	</div>

        <?php echo 
        "<script>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:900, height:200});

            });
        </script>"
        ?>
        
    </div>
    
    <div class="foot_panel">
        <a class="button rounded black"> Volver a Actividades </a>
    </div>
<!--<a href="<?php // echo url_for('Rubrica/new/?usuario='.$item->getLiteral()) ?>">New</a>-->

</div>