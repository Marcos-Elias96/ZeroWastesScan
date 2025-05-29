<?php
session_start();

// Configuración de conexión a la base de datos
$host = 'localhost';
$dbname = 'reciclaje_db';   // Cambia por el nombre real de tu base de datos
$username = 'root';          // Usuario por defecto en XAMPP
$password = '';              // Contraseña por defecto en XAMPP (vacía)

try {
    // Crear conexión PDO con charset UTF-8
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurar para mostrar excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Consulta para obtener la historia del reciclaje con id=1
$query = $pdo->prepare("SELECT * FROM historia_reciclaje WHERE id = 1");
$query->execute();
$historia = $query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>¿Ya nos conoces? - ZeroWastesScan</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #e8f5e9;
      margin: 0;
      padding-top: 56px; /* navbar height */
    }
    .navbar {
      background-color: #2e7d32 !important;
    }
    .navbar-brand, .nav-link {
      color: #c8e6c9 !important;
    }
     .btn-regresar:hover {
      background-color: #1b5e20;
    }
    section {
      padding: 80px 15px;
      min-height: 100vh;
      text-align: center;
    }
    footer {
      background:#2e7d32;
      color:#c8e6c9;
      text-align:center;
      padding:1rem;
    }
  </style>
</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">ZeroWastesScan</a>
  </div>
</nav>

<section>
  <h1>Conócenos</h1>
  <p>Descubre la historia del reciclaje y cómo contribuimos al cuidado del medio ambiente.</p>

  <div class="container mt-4">
    <h3>La Historia del Reciclaje</h3>
    <p><strong>¿Sabías que?</strong> El reciclaje tiene más de 2,000 años de historia. En la antigua Roma, las personas ya reciclaban materiales como vidrio y metales para hacer nuevos productos.</p>

    <p>
      <?php
        if ($historia && isset($historia['historia'])) {
            echo nl2br(htmlspecialchars($historia['historia']));
        } else {
            echo "La historia del reciclaje está en proceso de actualización. ¡Vuelve pronto!";
        }
      ?>
    </p>

    <h4>¿Cómo contribuye ZeroWastesScan al reciclaje?</h4>
    <p>En ZeroWastesScan, estamos comprometidos con el reciclaje y la educación ambiental. Ofrecemos soluciones para recolectar y procesar materiales reciclables de manera eficiente, promoviendo la conciencia ecológica entre los ciudadanos y las empresas. Nuestro objetivo es reducir el impacto ambiental y fomentar un mundo más limpio y verde.</p>
  </div>
</section>

    <link rel="stylesheet" href="css/estilos_combobox.css">
    <a href="index.php" class="btn-regresar">← Volver al inicio</a>

<footer>
  &copy; <?= date('Y') ?> ZeroWastesScan. Todos los derechos reservados.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
