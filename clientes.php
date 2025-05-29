<?php
include 'conexion.php';

$editar = false;
$clienteEdit = ['id' => '', 'nombre' => '', 'email' => ''];

// Eliminar cliente
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $conn->query("DELETE FROM clientes WHERE id = $id");
    header("Location: clientes.php");
    exit;
}

// Cargar cliente para edición
if (isset($_GET['editar'])) {
    $editar = true;
    $id = intval($_GET['editar']);
    $res = $conn->query("SELECT * FROM clientes WHERE id = $id");
    if ($res->num_rows > 0) {
        $clienteEdit = $res->fetch_assoc();
    }
}

// Guardar cliente (nuevo o actualizado)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    if (!empty($_POST['id'])) {
        // Actualizar
        $stmt = $conn->prepare("UPDATE clientes SET nombre = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nombre, $email, $_POST['id']);
    } else {
        // Nuevo
        $stmt = $conn->prepare("INSERT INTO clientes (nombre, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $email);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: clientes.php");
    exit;
}

// Obtener lista
$resultado = $conn->query("SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="estilos-globales.css" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2e7d32;">
  <div class="container">
    <a class="navbar-brand" href="#">ZeroWastesScan</a>
    <div class="ms-auto">
      <span class="text-white me-3">Usuario: <strong>admin</strong></span>
     <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2>Gestión de Clientes</h2>

  <form method="post" class="mb-4">
    <input type="hidden" name="id" value="<?= $clienteEdit['id'] ?>">

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= htmlspecialchars($clienteEdit['nombre']) ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($clienteEdit['email']) ?>">
    </div>

    <button type="submit" class="btn btn-<?= $editar ? 'warning' : 'primary' ?>">
      <?= $editar ? 'Actualizar Cliente' : 'Agregar Cliente' ?>
    </button>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['email']) ?></td>
            <td>
              <a href="?editar=<?= $fila['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="?eliminar=<?= $fila['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center text-muted">No hay clientes aún.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>