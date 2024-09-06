<!DOCTYPE html>
<html lang="es">
<head>
  <title>Empleados - Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
<body>

<div class="container-fluid">
  <h2>Listado de empleados</h2>

  <div>
  <a href="?c=empleado&a=crearEmpleado" class="btn btn-primary" role="button" data-bs-toggle="button"><i class="fa fa-solid fa-user-plus"></i> Crear</a>
  </div>

  <br>
  <table class="table table-hover">
    <thead>
      <tr>
        <th><i class="fa-solid fa-user" style="color: #000000"></i> Nombre</th>
        <th><i class="fa-solid fa-at" style="color: #000000"></i> Email</th>
        <th><i class="fa-solid fa-venus-mars" style="color: #000000"></i> Sexo</th>
        <th><i class="fa-solid fa-briefcase" style="color: #000000"></i> Area</th>
        <th><i class="fa-solid fa-envelope" style="color: #000000"></i> Boletin</th>
        <th><i class="fa-solid fa-pen-to-square" style="color: #000000"></i> Modificar</th>
        <th><i class="fa-solid fa-trash-can" style="color: #000000"></i> Eliminar</th>
      </tr>
    </thead>
    <tbody>

<?php $data = $this->model->index();
if (!isset($data) || empty($data)) {
    echo "<h3>No existen empleados actualmente.</h3>";
}?>

        <?php foreach($this->model->index() as $r): ?>
            <tr>
                <td><?php echo $r->nombre; ?></td>
                <td><?php echo $r->email; ?></td>
                <td><?php echo ($r->sexo == 'M') ? 'Masculino' : 'Femenino'; ?></td>
                <td><?php echo $r->area; ?></td>
                <td><?php echo ($r->boletin == 'S') ? 'SI' : 'NO'; ?></td>
                <td>
                    <a href="?c=empleado&a=seleccionarEmpleado&id=<?php echo $r->id; ?>"><i class="fa-solid fa-pen-to-square fa-lg" style="color: #000000"></i></a>
                </td>
                <td>
                    <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=empleado&a=eliminarEmpleado&idEmpleado=<?php echo $r->id; ?>"><i class="fa-solid fa-trash-can fa-lg" style="color: #000000"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

<hr>

  <div class="card" style="width: 50%;">
    <img class="card-img-top" src="imagenes/MER_BD.jpg" alt="ER">
    <div class="card-body">
      <p class="card-text">Diagrama ENTIDAD-RELACION, de la base de datos utilizada en el proyecto.</p>
    </div>
  </div>

</div>

</body>
</html>
