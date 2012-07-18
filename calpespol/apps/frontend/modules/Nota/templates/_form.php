<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('Nota/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_estudiante='.$form->getObject()->getIdEstudiante().'&idliteral='.$form->getObject()->getIdliteral() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('Nota/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'Nota/delete?id_estudiante='.$form->getObject()->getIdEstudiante().'&idliteral='.$form->getObject()->getIdliteral(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['nota_literal']->renderLabel() ?></th>
        <td>
          <?php echo $form['nota_literal']->renderError() ?>
          <?php echo $form['nota_literal'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_calificador']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_calificador']->renderError() ?>
          <?php echo $form['id_calificador'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['comentario']->renderLabel() ?></th>
        <td>
          <?php echo $form['comentario']->renderError() ?>
          <?php echo $form['comentario'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
