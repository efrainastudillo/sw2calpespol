<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('Rubrica/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('Rubrica/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'Rubrica/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['id_actividad']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_actividad']->renderError() ?>
          <?php echo $form['id_actividad'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['literal']->renderLabel() ?></th>
        <td>
          <?php echo $form['literal']->renderError() ?>
          <?php echo $form['literal'] ?>
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
        <th><?php echo $form['valor_max']->renderLabel() ?></th>
        <td>
          <?php echo $form['valor_max']->renderError() ?>
          <?php echo $form['valor_max'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
