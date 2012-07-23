<?php use_stylesheet('modulo/form.css') ?>
<?php use_stylesheet('modulo/boton.css') ?>

<form class="formulario" action="actividad/SaveLiteral"  method="post">
    <legend>Nuevo Literal</legend>
    <div id="div_linea_bajo_menu"></div>
    <label for="descripcion">Descripción</label>
    <input class="texto" id="descripcion" name="detalle" type="text" size="20" />
    <label for="puntaje">Puntaje</label>
    <input class="texto" id="puntaje" name="puntos" type="text" size="20" />
    <input class="button rounded black" id="save" name="save" type="submit" value="Guardar"/>
</form>