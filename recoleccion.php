<?php
include 'conexion.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['solicitar'])) {
    $nombre = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $residuos = $_POST['residuos'] ?? [];

    if ($nombre && $direccion && $telefono && count($residuos) > 0) {
        $residuos_str = implode(", ", $residuos);

        $stmt = $conn->prepare("INSERT INTO solicitudes_recoleccion (nombre, direccion, telefono, residuos) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $direccion, $telefono, $residuos_str);

        if ($stmt->execute()) {
            // Enviar correo de notificación
            $to = "elias96marcos@gmail.com"; // Cambia a tu correo real
            $subject = "Nueva solicitud de recolección ZeroWastesScan";
            $message = "Detalles de la solicitud:\n\n";
            $message .= "Nombre: $nombre\n";
            $message .= "Dirección: $direccion\n";
            $message .= "Teléfono: $telefono\n";
            $message .= "Residuos: $residuos_str\n";

            $headers = "From: noreply@tusitio.com\r\n" .
                       "Reply-To: noreply@tusitio.com\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            mail($to, $subject, $message, $headers);

            $mensaje = "Solicitud enviada correctamente. Gracias por reciclar.";
        } else {
            $mensaje = "Error al enviar la solicitud. Intenta más tarde.";
        }
        $stmt->close();
    } else {
        $mensaje = "Por favor completa todos los campos y selecciona al menos un tipo de residuo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Solicitud de Recolección - ZeroWastesScan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin=""
  />

  <style>
    #map {
      height: 400px;
      width: 100%;
      border-radius: 12px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

<div class="container my-5">
  <h1>Servicios de Reciclaje</h1>
  <p>Encuentra centros de reciclaje cercanos y solicita recolección programada.</p>

  <?php if ($mensaje): ?>
    <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
  <?php endif; ?>

  <div id="map"></div>

  <h3>Solicitar Recolección</h3>
  <form method="POST" class="mb-5">
    <input type="hidden" name="solicitar" value="1" />
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre completo</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required />
    </div>

    <div class="mb-3">
      <label for="direccion" class="form-label">Dirección de recolección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" required />
    </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Teléfono</label>
      <input type="tel" class="form-control" id="telefono" name="telefono" required />
    </div>

    <div class="mb-3">
      <label class="form-label">Tipos de residuos a reciclar</label><br />
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="plastico" name="residuos[]" value="Plástico" />
        <label class="form-check-label" for="plastico">Plástico</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="carton" name="residuos[]" value="Cartón" />
        <label class="form-check-label" for="carton">Cartón</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="vidrio" name="residuos[]" value="Vidrio" />
        <label class="form-check-label" for="vidrio">Vidrio</label>
      </div>
    </div>

    <button type="submit" class="btn btn-success">Enviar solicitud</button>
  </form>

  <a href="servicios.php" class="btn btn-secondary">Volver a Servicios</a>
</div>

<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  crossorigin=""
></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const map = L.map('map').setView([19.292, -99.651], 9); // Estado de México

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors',
  }).addTo(map);

  const centros = [
    { nombre: "Centro Reciclaje Toluca", coords: [19.2826, -99.6557], descripcion: "Horario: 9am - 5pm" },
    { nombre: "Punto de Acopio Naucalpan", coords: [19.4785, -99.2343], descripcion: "Horario: 8am - 4pm" },
    { nombre: "Centro Ecológico Ecatepec", coords: [19.6014, -99.0520], descripcion: "Horario: 10am - 6pm" }
  ];

  centros.forEach(c => {
    L.marker(c.coords).addTo(map).bindPopup(`<b>${c.nombre}</b><br>${c.descripcion}`);
  });
});
</script>


</body>
</html>