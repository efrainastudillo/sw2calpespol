<?php 
//// Autor:          Efrain Astudillo 
//   Descripcion:   Crea las materias para el Sistema
//   
?>
<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/education.png', array('alt_title'=>'Materia','size'=>'70x70')) ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Materias" ?>
<?php end_slot(); ?>

<?php slot('materia-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<div class="panel">
    <div class="head_panel">
        
        <div class="titulo_head_panel">
            <p>Nueva Materia</p>            
        </div>
        
    </div>

    <div class="body_panel">
        
        <div class="titulo_body_panel">
            <div style="margin-right:200px;color: red;"  class="extra_head_panel">
               <?php if ($sf_user->hasFlash('mensaje')): ?>
                  <div><?php echo $sf_user->getFlash('mensaje') ?></div>
                <?php endif ?>
            </div>
        </div>
        
        <div id="regresar_lista" class="boton_new">
            <a href="<?php echo url_for("Materia/index")?>" class="button" >
                <img src="../images/new.png" width="15" height="15" /> Regresar a Lista de Materias
            </a>
        </div>
        <div style="clear: both;visibility: hidden"></div>
        <div>
            <form id="form_materia" action="<?php echo url_for('Materia/create') ?>" method="POST">
                <input id="materia_tipo" name="tipo" type="hidden" value=""/>
                <select id="materia_lista_tipo" onchange="materiasRefreshFromList();">
                    <option selected="selected">Seleccione un tipo de materia</option>
                    <option>Materia ESPOL</option>
                    <option>Otra</option>
                </select>
                <div id="materia_inner_div" style="display: none">
                    <table>
                        <tr id="materia_nombre">
                            <th>Nombre:</th>
                            <td><input id="new_materia_nombres" name="nombre" type="text" placeholder="Nombre de Materia" value="" onkeypress="return soloLetrasConEspacio(event);"/></td>
                            <td><span id="req-nombres" class="requisites">Tiene deshabilitado Javascript</span></td>
                        </tr>
                        <tr  id="materia_codigo">
                            <th>Código:</th>
                            <td><input id="new_materia_codigo" name="codigo" type="text" placeholder="Codigo de Materia" value="" onkeypress="return soloAlfanumericoSinEspacio(event);"/></td>
                            <td><span id="req-codigo" class="requisites">Tiene deshabilitado Javascript</span></td>
                        </tr>
                        <tr  id="materia_userEspol">
                            <th>Profesor:</th>
                            <td><input id="new_materia_profesor" name="profesor" type="text" placeholder="Usuario de ESPOL" value="" onkeypress="return soloAlfanumericoSinEspacio(event);"/></td>
                            <td><span id="req-codigo" class="requisites">Tiene deshabilitado Javascript</span></td>
                        </tr>
                        <tr  id="materia_paralelo">
                            <th>Paralelo:</th>
                            <td><input id="new_materia_paralelo" name="paralelo" type="text" placeholder="Numero del Paralelo" value="" onkeypress="return soloNumerosSinEspacio(event);"/></td>
                            <td><span id="req-codigo" class="requisites">Tiene deshabilitado Javascript</span></td>
                        </tr>
                        <tr>
                        <td colspan="2">
                            <input class="materia_boton_nuevo" type="submit" value="crear" />
                        </td>
                      </tr>
                    </table>
                </div>
            </form>
        </div>
        <div class="mensaje_ayuda"><p>Verifique que los Datos estén correctamente Ingresados</p></div>
    </div> 
    
</div>
    