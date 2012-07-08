<?php slot('logo') ?>
    <?php echo image_tag('/images/estudiantes.png', 'alt_title=Estudiantes') ?>
<?php end_slot(); ?>
<?php slot('title') ?>
    <?php echo "Estudiantes" ?>
<?php end_slot(); ?>

<?php slot('estudiante-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>
<?php use_stylesheet('estilo.css') ?>
<?php use_stylesheet('estudiante/estudiante.css') ?>
<?php use_javascript('estudiante.js') ?>

<div class="panel">
    
    <!--Barra informativo de la categoria de actividad: nombre, tipo de actividad y tipo de categoria    -->
    <div id="info">
            <!--nombre de categoria de actividad      -->
            <div id="contenido_izq">
                Agregar Estudiante
            </div>
    </div>
    <div id="contenedor_tabla" class="contenedor_tabla">
        <form method="POST" action="process" >
        <div id="prueba"></div>
         <table>
            <tbody>
                <tr>
                <th> <label for="idUsuario">ID:</label></th>
                <td>
                    <input name="idUsuario" type="text" id="idUsuario" />
                   
                </td>
                <td>
                    <span id="req-iduser" class="requisites"></span>
                </td>
              </tr>
              <tr>
                <th> <label for="nombre">Nombre:</label></th>
                <td>
                    <input name="nombre" type="text" id="nombre" />
                    
                </td>
                <td >
                    <span id="req-username" class="requisites">Tiene deshabilitado Javascript</span>
                </td>
              </tr>
              <tr>
                <th><label  for="email">E-Mail:</label></th>
                <td>
                    <input name="email" type="text" id="email" />
                    
                </td>
                <td>
                    <span id="req-email" class="requisites">Tiene deshabilitado Javascript</span>
                </td>
              </tr>
              
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3">

                    <input id="grabarEstudiante" type="button" value="Grabar" />
                </td>
              </tr>

            </tfoot>
          </table>
        </form>
    </div>
</div>