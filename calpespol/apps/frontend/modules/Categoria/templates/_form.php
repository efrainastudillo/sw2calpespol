<!-- IndexSucces del Modulo Inicio -->
<?php slot('logo') ?>
    <?php echo image_tag('/images/actividades.png', 'alt_title=Actividades') ?>
<?php end_slot(); ?>

<?php slot('title') ?>
    <?php echo "Actividades" ?>
<?php end_slot(); ?>

<?php slot('inicio-css') ?>
    <?php echo "selected" ?>
<?php end_slot(); ?>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('Categoria/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('Categoria/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'Categoria/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Continuar" href="<?php echo url_for('Actividad/new') ?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['id_curso']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_curso']->renderError() ?>
          <?php echo $form['id_curso'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['nombre']->renderLabel() ?></th>
        <td>
          <?php echo $form['nombre']->renderError() ?>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['periodo']->renderLabel() ?></th>
        <td>
          <?php echo $form['periodo']->renderError() ?>
          <?php echo $form['periodo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['porcentaje']->renderLabel() ?></th>
        <td>
          <?php echo $form['porcentaje']->renderError() ?>
          <?php echo $form['porcentaje'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_tipo_categoria']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_tipo_categoria']->renderError() ?>
          <?php echo $form['id_tipo_categoria'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
