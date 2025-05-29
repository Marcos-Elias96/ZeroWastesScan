<?php
$mensajeCita = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $fecha = trim($_POST['fecha'] ?? '');
    $hora = trim($_POST['hora'] ?? '');

    if ($nombre && $email && $fecha && $hora) {
        $mensajeCita = "Cita agendada correctamente para el " . htmlspecialchars($fecha) . " a las " . htmlspecialchars($hora) . ". ¡Gracias!";
    } else {
        $mensajeCita = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agendar Cita - ZeroWastesScan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container my-5">
    <h1>Agendar una Cita</h1>

    <?php if ($mensajeCita): ?>
      <div class="alert alert-info"><?= $mensajeCita ?></div>
    <?php endif; ?>

    <form method="POST" class="mb-5" novalidate>
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha" required />
      </div>
      <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" class="form-control" id="hora" name="hora" required />
      </div>
      <button type="submit" class="btn btn-success">Agendar Cita</button>
    </form>

    <a href="index.php" class="btn btn-secondary">Atras</a>
  </div>
</body>
</html>