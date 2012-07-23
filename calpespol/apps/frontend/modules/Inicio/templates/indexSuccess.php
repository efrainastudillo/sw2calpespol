<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/inicio.png', 'alt_title=Inicio') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Inicio" ?>
<?php end_slot(); ?>

<?php slot('inicio-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<h1>Authenticacion con Servicio Web</h1>
<form action="<?php echo url_for('Inicio/index') ?>" method="POST">
  <table>
    <tr>
       <?php foreach ($fecha as $f){
           echo $f->getNombre();
           echo $sf_context->getModuleName();
           echo $sf_context->getActionName();
           //echo $variable;
           echo $sf_user->getMateriaActual();
       }?>
      <td colspan="2">
        <input type="submit" />
        <?php echo link_to('Delete', 'Estudiante/index', array('popup' => array('popupWindow', 'width=600,height=400,left=320,top=0'))) ?>
      </td>
    </tr>
  </table>
</form>
 