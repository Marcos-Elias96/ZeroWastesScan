<?php
include 'conexion.php'; // Asegúrate que el archivo conexión esté también en la raíz

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['solicitar'])) {
    $nombre = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);

    if ($nombre && $direccion && $telefono) {
        $stmt = $conn->prepare("INSERT INTO solicitudes_recoleccion (nombre, direccion, telefono) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $direccion, $telefono);

        if ($stmt->execute()) {
            $mensaje = "Solicitud enviada correctamente. Gracias por reciclar.";
        } else {
            $mensaje = "Error al enviar la solicitud. Intenta más tarde.";
        }
        $stmt->close();
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Servicios - ZeroWastesScan</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">

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
  <h1>Buscar Dirección en Google Maps</h1>
  <p>Por favor, ingresa una dirección y busca su ubicación en el mapa.</p>

  <?php if ($mensaje): ?>
    <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
  <?php endif; ?>

  <div id="map"></div>

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

    <button type="button" id="buscarButton" class="btn btn-primary">Buscar en Google Maps</button>
    <a href="index.php" class="btn btn-secondary">Atras</a>
  </form>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const map = L.map('map').setView([19.292, -99.651], 9); // Ubicación inicial del mapa en México.

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

  // Función para geocodificar la dirección proporcionada
  function geocodeDireccion(direccion) {
    const apiKey = 'AIzaSyC-vxtzt88GyYqq-ahchLqgrqBBX1hUsv8';  // Asegúrate de reemplazar esta línea con tu clave API
    const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(direccion)}&key=${apiKey}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        console.log(data); // Aquí se muestra la respuesta completa en la consola
        if (data.status === "OK") {
          const latLng = data.results[0].geometry.location;
          map.setView([latLng.lat, latLng.lng], 12); // Centra el mapa en las coordenadas obtenidas

          // Añadir un marcador en el mapa con las coordenadas
          L.marker([latLng.lat, latLng.lng]).addTo(map)
            .bindPopup(`<b>Ubicación de la dirección</b><br>${direccion}`)
            .openPopup();
        } else {
          alert("No se pudo geocodificar la dirección. Asegúrate de ingresar una dirección completa.");
        }
      })
      .catch(error => {
        console.error("Error al geocodificar:", error);  // Ver detalles del error
        alert("Hubo un problema al geocodificar la dirección. Intenta de nuevo más tarde.");
      });
  }

  // Manejar el click en el botón "Buscar en Google Maps"
  const buscarButton = document.getElementById("buscarButton");
  buscarButton.addEventListener("click", function () {
    const direccion = document.getElementById("direccion").value;
    if (direccion) {
      geocodeDireccion(direccion);  // Geocodifica y actualiza el mapa con la dirección.
    } else {
      alert("Por favor, ingresa una dirección.");
    }
  });
});
</script>

</body>
</html>