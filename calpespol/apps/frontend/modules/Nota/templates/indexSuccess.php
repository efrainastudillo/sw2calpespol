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
            <div class="extra_head_panel">
               <?php echo "<p>".$sf_user->getMateriaActual()."</p>"; ?>
            </div>
    </div>
    <!--Body para mostrar actividades    -->
    <div class="body_panel">
        <div class="titulo_body_panel">
            <div class="materia">
                <p> Materia: </p>
                <select id="materias" name="materias" size="1" id="mat_selec" >
                    <?php foreach ($materia as $mat): ?>
                        <option value="">
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
                        <?php //
                       // if ($literal = 1) {
                       //     echo "<td>Estudiantes</td>";
                       // } else {
                       //     echo "<td>Grupos</td>";
                        //}
                        ?>
                   
                        
                        <td>Grupos</td>
                        <?php
                        if (isset($literal)) {
                            $i=1;
                            foreach ($literal as $lit) {
                                echo "<td>" . "Literal ". $i++ ." (" .$lit-> getValorPonderacion().")"  . "</td>";
                            }
                        }
                        ?>
                        <td>Total</td> 
                    </tr>
                </thead>
                <tbody>
                    <!--Aqui va la tabla que muestra todas las actividades-->
                    <?php
                    if (isset($usuario)) {
                        echo $usuario->count();
                        foreach ($usuario as $us) {
                            echo "<tr>";
                            echo "<td>" . $us->getNombre() . "</td>";
                            if (isset($literal)) {
                                foreach ($literal as $lit) {
                                    echo "<td><input type='text' placeholder='nota' size='3' maxlength='3' style='text-align:right'></td>";
                                }
                            }
                            echo "<td>10</td>";
                            echo "</tr>";
                          
                          //echo "<td>" . "Literal (" . $lit->getValorPonderacion() . ")" . "</td>";
                            }
                        }
//                        ?>
                </tbody>
            </table>
        </div>
 </div>       
        
        <div class="tableScroll" style="margin-top: 1em">
        <table class="tabla" cellspacing="0">
            <thead>
                <tr>
                    <td>Literales</td>
                    <td>Descripción</td>
                </tr>
            </thead>
            <tbody>
                 <?php 
                    if(isset ($literal)){
                        $i=1;
                        foreach ($literal as $lit){
                            echo "<tr>";
                                echo "<td>" . "Literal ". $i++ ." (" . $lit->getValorPonderacion() . ")" . "</td>";
                                echo "<td>".$lit->getNombreLiteral()."</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
            </tbody>
        </table>
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