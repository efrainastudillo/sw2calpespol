<h1>Categorias List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id curso</th>
      <th>Nombre</th>
      <th>Periodo</th>
      <th>Porcentaje</th>
      <th>Id tipo categoria</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorias as $categoria): ?>
    <tr>
      <td><a href="<?php echo url_for('Categoria/edit?id='.$categoria->getId()) ?>"><?php echo $categoria->getId() ?></a></td>
      <td><?php echo $categoria->getIdCurso() ?></td>
      <td><?php echo $categoria->getNombre() ?></td>
      <td><?php echo $categoria->getPeriodo() ?></td>
      <td><?php echo $categoria->getPorcentaje() ?></td>
      <td><?php echo $categoria->getIdTipoCategoria() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('Categoria/new') ?>">New</a>
