<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('Estudiante/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('Estudiante/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'Estudiante/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
        <th><?php echo $form['id_usuario']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_usuario']->renderError() ?>
          <?php echo $form['id_usuario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_grupo']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_grupo']->renderError() ?>
          <?php echo $form['id_grupo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
