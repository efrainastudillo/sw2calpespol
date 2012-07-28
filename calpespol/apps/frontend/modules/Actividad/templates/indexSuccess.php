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
    <!--Body para mostrar actividades    -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <!--div que contiene al comboBox de paralelos    -->
            <div class="item_1">
               <p> <label class="labelsForm" for="paralelo"> Paralelo: </label> </p>
               <select name="paralelo" size="1" id="parale_selec" >
                    <?php foreach ($q as $para): ?>
                    <option>
                        <?php echo $para->getParalelo(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
           </div>
            
           <!--div que contiene al comboBox de materias    -->
           <div class="item_2">
               <p> <label class="labelsForm" for="paralelo"> Materia: </label> </p>
               <select name="materia" size="1" id="materia_selecionada" >
                    <?php foreach ($m as $mat): ?>
                    <option>
                        <?php echo $mat->getNombre(); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
           </div>
           <!--div que contiene al comboBox de termino    -->
           <div class="item_3">
               <p> <label class="labelsForm" for="paralelo"> Termino: </label> </p>
               <select name="termino" size="1" id="termino_seleccionado" >
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
           </div> 
           
        </div>
        
        <!--div que contiene el boton de Crear nueva actividad    -->
        <div class="boton_new" style="margin: 0.5em; margin-right: 0em;">
            <a href="#" class="button rounded black" id="new">
                <img src="../images/find.png" width="15" height="15" /> Consultar
            </a> 
        </div>
        
        <!--div que divide la consulta de la tabla de datos    -->
        <div id="div_linea_bajo_menu" style="margin-top: 0.5em;"></div>
          
        <!--div que contiene el boton de Crear nueva actividad    -->
        <div class="boton_new" style="margin-right: 1em; ">
            <a href="Actividad/NewView" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Nueva Actividad
            </a> 
        </div>
        
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
                <!--Aqui va la tabla que muestra todas las actividades-->
                <?php foreach ($a as $acti): ?>
                    <tr>
                        <!--Flecha indicadora si esta visible o no los literales de una actividad-->
                        <td  class="actividad" style="padding: 0em;"><img src="../images/arrow-right-3.png" class="flecha_literal" id=<?php echo sha1($acti->getIdActividad())?> ></td>
                        <!--Nombre de la actividades-->
                        <td><?php echo $acti->getNombre(); ?></td>
                        <!--Nombre del tipo de la actividad-->
                        <td><?php echo $acti->getTipoactividad()->getNombre(); ?></td>
                        <!--Si es grupal o individual-->
                        <td><?php if ($acti->getTipoactividad()->getEsGrupal()) echo "Grupal"; else echo "Individual"; ?></td>
                        <!--Valor del tipo actividad, ponderacion-->
                        <td><?php echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
                        <td><a href="#" ><img src="../images/edit_2.png" width="15" height="15" title="Edita la actividad"/></a>&nbsp &nbsp 
                            <a href="#" ><img src="../images/delete_2.png" width="15" height="15" title="Elimina la actividad" /></a>&nbsp &nbsp 
                            <a href="javascript:void(0);" id="nuevo_literal"><img src="../images/add.png" width="15" height="15" title="Nuevo Literal" /></a>
                        </td>
                    </tr>  
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!--Aquí van las tablas que muestran los literales de cada actividad-->
        <?php foreach($a as $acti): ?>
            <?php $total = 0;?> 
            <div>
                <table class="tabla2 <?php echo sha1($acti->getIdActividad())?>">
                    
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
                                <a href="<?php echo url_for('Actividad/newLiteral/?actividad='.(sha1($acti->getIdActividad())).'&literal='.(sha1($lit->getIdLiteral()))) ?>" >
                                    <img src="../images/delete_2.png" width="15" height="15" />
                                </a>
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
                    $('.tabla').tableScroll({width:950, height:150, containerClass:'tabla_actividad'});
                    $('.tabla2').tableScroll({width:950, height:75, containerClass:'tabla_literal'});
                });
            </script>"
        ?>

    </div>
</div>