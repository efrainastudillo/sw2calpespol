<!-- IndexSucces del Modulo Actividad -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/notas.png', 'alt_title=Notas') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Notas" ?>
<?php end_slot(); ?>

<?php slot('nota-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_stylesheet('/css/modulo/nota/nota.css');?>
<?php use_javascript('/js/rubrica.js')?>
<div class="panel">
    <div class="head_panel">
            <div class="titulo_head_panel">
                <p>Ingreso de Notas</p>
            </div>
<!--            <div class="extra_head_panel">
                <p> Laboratorio de Potencia 1</p>
            </div>-->
    </div>
    <!--Body para mostrar actividades    -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <div class="materia">
                <p> Materia: </p>
                <select id="materias" name="materias" size="1" id="mat_selec" >
                    <?php foreach ($materia as $mat): ?>
                        <option>
                            <?php echo $mat->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
            </div>
            <?php // echo $_POST['materias']; ?>
            <div class="paralelo">
                <p> Paralelo: </p>
                <select name="paralelo" size="1" id="paralelo_selec" >
                    <?php foreach ($curso as $cur): ?>
                        <option>
                            <?php echo $cur->getParalelo(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="actividad">
                <p> Actividad: </p>
                <select name="actividad" size="1" id="acti_selec" >
                    <?php foreach ($actividad as $act): ?>
                        <option>
                            <?php echo $act->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="boton_new">
            <a href="Actividad/new" class="button rounded black" id="new">
                <img src="../images/new.png" width="15" height="15" /> Cargar Información
            </a> 
        </div>
        
        <div class="tableScroll">
            <table class="tabla" cellspacing="0">
                <thead>
                    <tr>
<!--                        <td>Grupos</td>
                        <td>Literal 1 (2p)</td>                       
                        <td>Literal 2 (2p)</td>
                        <td>Literal 3 (2p)</td>
                        <td>Literal 4 (2p)</td>
                        <td>Total</td>-->
                        <td>Grupos</td>
                        <?php
                        if (isset($literal)) {
                            foreach ($literal as $lit) {
                                echo "<td>" . $lit->getNombreLiteral(). "</td>";
                            }
                        }
                        ?>
                        <td>Total</td>
                        
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui va la tabla que muestra todas las actividades-->
                    <?php // foreach ($a as $acti): ?>
                    <tr>
                        <td>Grupo 1</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                                        <tr>
                        <td>Grupo 2</td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td><input type="text" placeholder="nota" size="3" maxlength="3" style="text-align:right"></td>
                        <td>10</td>
                    </tr>
                    

                <!--//      Nombre de la actividad/es-->
                            <td><?php // echo $acti->getNombre(); ?></td>
                <!--//      Nombre del tipo de la actividad-->
                            <td><?php // echo $acti->getTipoactividad()->getNombre(); ?></td>
                <!--//      Si es grupal o individual-->
                            <td><?php // if ($acti->getTipoactividad()->getEsGrupal()) echo "Grupal"; else echo "Individual"; ?></td>
                <!--//      Valor del tipo actividad, ponderacion-->
                            <td><?php // echo $acti->getTipoactividad()->getValorPonderacion(); ?></td>
<!--                            <td><a href="#" ><img src="../images/edit (2).png" width="15" height="15" /></a>
                                <a href="#" ><img src="../images/delete (2).png" width="15" height="15" /></a>
                                <a href="#" ><img src="../images/add.png" width="15" height="15" /></a>
                            </td>
                        </tr>-->
                    <?php // endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo 
        "<script>
            jQuery(document).ready(function($)
            {
                $('.tabla').tableScroll({width:950, height:200});

            });
        </script>"
    ?>
    
</div>