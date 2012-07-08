<?php use_stylesheet('modulo/form.css') ?>
<?php use_stylesheet('modulo/boton.css') ?>
<?php use_javascript('rubrica.js') ?>

<form class="formulario">
    <legend>Nuevo Literal</legend>
    <label for="descripcion">Descripción</label>
    <input class="texto" id="descripcion" name="detalle" type="text" size="20" />
    <label for="puntaje">Puntaje</label>
    <input class="texto" id="puntaje" name="puntos" type="text" size="20" />
    <input class="button rounded black" id="save" name="save" type="submit" value="Guardar"/>
</form>
