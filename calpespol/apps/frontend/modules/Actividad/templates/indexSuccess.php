<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('actividad-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_stylesheet('modulo/actividad/actividad.css') ?>
<?php use_javascript('actividad.js') ?>

<div class="panel">
    
    <!--Barra informativo de la categoria de actividad: nombre, tipo de actividad y tipo de categoria    -->
    <div id="info">
            <!--nombre de categoria de actividad      -->
            <div id="contenido_izq">
                Crear Actividad
            </div>
    </div>
    <div id="contenedor_tabla" class="contenedor_tabla">
        <form method="POST" action="Actividad/index" >
        <div id="prueba"></div>
         <table>
            <tbody>
              <tr>
                <th><label class="labelsForm" for="anios">Año:</label></th>
                <td><select  id="anio_selec" name="anios" size="1" >
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select>
                </td>
              </tr>
              <tr>
                <th> <label class="labelsForm" for="terminos">Termino:</label></th>
                <td>
                    <select id="termino_selec" name="terminos" size="1" >
                        <option>I</option>
                        <option>II</option>
                        <option>III</option>
                    </select>
                </td>
              </tr>
              <tr>
                <th><label class="labelsForm" for="periodos">Periodo:</label></th>
                <td>
                    <select name="periodos" size="1" id="periodo_selec" >
                        <option>1 Parcial</option>
                        <option>2 Parcial</option>
                     </select>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="materias">Materia:</label>
                </th>
                <td> 
                    <select name="materias" size="1" id="materia_select" onchange="">
                                    <option>Seleccione una materia</option>
                            </select>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="paralelos">Paralelo:</label>
                </th>
                <td> 
                    <select name="paralelos" size="1" id="paralelo_select" onchange="">
                                    <option>Seleccione el paralelo</option>
                             </select>
                </td>
              </tr>
              <tr>
                <th>
                     <label  for="categoria"> Categoria de la actividad:</label>
                </th>
                <td> 
                    <select name="categoria" id="categoria_selec">
                                                  <option>Deber</option>
                                                  <option>Leccion</option>
                                                  <option>Practica</option>
                                                  <option>Examen</option>
                                                </select>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="porcentaje"> Porcentaje: </label>
                </th>
                <td> 
                    <input name="porcentaje" type="text" id="porcentaje" /><label>%</label>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="porcentaje"> Actividad Regular : </label>
                </th>
                <td> 
                    <select name="tipocategorias" size="1" id="tipocategoria_select" onchange="">
                                            <option>SI</opcion>
                                            <option>NO</opcion>
                                       </select>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="porcentaje"> Decripción: </label>
                </th>
                <td> 
                    <input name="descripcion" type="text" id="descripcion"/>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="fecha"> Fecha: </label>
                </th>
                <td> 
                    <input name="fecha" type="date" id="fecha"/>
                </td>
              </tr>
              <tr>
                <th>
                     <label class="labelsForm" for="tipocalificaciones"> Actividad Individual: </label>
                </th>
                <td> 
                     <select name="tipocalificaciones" size="1" id="tipocalificacion_select" onchange="">
                                            <option>SI</opcion>
                                            <option>NO</opcion>
                                         </select>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">

                  <input type="submit" value="Crear Actividad" />
                </td>
              </tr>

            </tfoot>
          </table>
        </form>
    </div>
</div>