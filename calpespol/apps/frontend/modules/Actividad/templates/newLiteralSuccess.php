<?php use_stylesheet('modulo/form.css') ?>
<?php use_stylesheet('modulo/boton.css') ?>
<?php use_javascript('literal.js')?>

<form class="formulario" action="actividad/SaveLiteral"  method="POST">
    <legend>Nuevo Literal</legend>
    <div id="div_linea_bajo_menu"></div>
    <label for="descripcion">Descripción</label>
    <input class="texto" id="descripcion" name="detalle" type="text" size="20" /><span id="req-Descrip">Tiene deshabilitado el JavaScript</span>
    <label for="puntaje">Puntaje</label>
    <input class="texto" id="puntaje" name="puntos" type="text" size="20" /><span id="req-Punto">Tiene deshabilitado el JavaScript</span>
    <input type="hidden" name="actividad" value="<?php echo $id_actividad_literal?>">
    <input class="button rounded black" id="save" name="save" type="submit" value="Guardar"/>
</form>