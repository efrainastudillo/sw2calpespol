<!--
 * Actividad template.
 *
 * @package    CALPESPOL
 * @subpackage Actividad
 * @template   newLiteral
 * @author     Jefferson Rubio
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 *-->



<form class="formulario" action="<?php echo url_for("Actividad/saveLiteral")?>"  method="POST">
    <legend>Nuevo Literal</legend>
    <div id="div_linea_bajo_menu"></div>
    <label for="descripcion">Descripción</label>
    <input class="texto" id="descripcion" name="detalle" type="text" size="20" placeholder="Descripción del literal"/>
    <span id="req-Descrip">Tiene deshabilitado el JavaScript</span>
    <label for="puntaje">Puntaje</label>
    <input class="texto" id="puntaje" name="puntos" type="text" size="20" placeholder="Valor del literal"/>
    <span id="req-Punto">Tiene deshabilitado el JavaScript</span>
    <input type="hidden" name="actividad" value="<?php echo $id_actividad_literal?>">
    <input class="button" id="save" name="save" type="submit" value="Guardar"/>
</form>