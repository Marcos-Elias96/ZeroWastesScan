<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ZeroWastesScan - Productos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="estilos-globales.css" />

  <!-- Font Awesome para los íconos sociales -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #e8f5e9;
      margin: 0;
      padding-top: 56px;
      scroll-behavior: smooth;
    }

    .navbar {
      background-color: #2e7d32 !important;
    }

    .navbar-brand, .nav-link {
      color: #c8e6c9 !important;
    }

    section {
      padding: 80px 15px;
      min-height: 100vh;
      text-align: center;
    }

    .card-custom {
      background: white;
      border-radius: 12px;
      width: 280px;
      padding: 1rem;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      margin: 1rem auto;
      transition: transform 0.3s ease;
    }

    .card-custom:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .card-custom img {
      max-width: 100%;
      border-radius: 8px;
      height: 180px;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    footer {
      background:#2e7d32;
      color:#c8e6c9;
      text-align:center;
      padding:1rem;
    }

    #btnLoginSmall {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: #2e7d32;
      color: #c8e6c9;
      border: 2px solid #c8e6c9;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      z-index: 1050;
      transition: background-color 0.3s, color 0.3s;
    }

    #btnLoginSmall:hover {
      background-color: #a5d6a7;
      color: #2e7d32;
      border-color: #a5d6a7;
    }

    /* Estilo para los íconos sociales */
    .social-icons {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .social-icons a {
      font-size: 30px; /* Tamaño del icono */
      color: #fff; /* Color blanco para que resalten */
      text-decoration: none; /* Eliminar subrayado */
      transition: all 0.3s ease;
    }

    .social-icons a:hover {
      color: #4CAF50; /* Cambio de color al pasar el mouse */
      transform: scale(1.1); /* Efecto de aumento al pasar el mouse */
    }

  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">ZeroWastesScan</a>
    <div class="ms-auto d-flex justify-content-center align-items-center w-100">

      <!-- Íconos de redes sociales -->
      <div class="social-icons">
        <a href="https://www.google.com" target="_blank" title="Google"><i class="fab fa-google"></i></a>
        <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
      </div>

      <a href="conocenos.php" class="nav-link text-light mx-3">Conócenos</a>

      <div class="input-group mx-3" style="width: 250px;">
        <input type="text" class="form-control" placeholder="Ingresa tu Código Postal" aria-label="Código Postal" />
      </div>

      <ul class="navbar-nav">
        <li class="nav-item dropdown" style="list-style:none;">
          <a
            class="nav-link dropdown-toggle text-light mx-3"
            href="#"
            id="serviciosDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          
            Servicios
          </a>
          <ul class="dropdown-menu" aria-labelledby="serviciosDropdown">
            <li><a class="dropdown-item" href="servicios.php">Mapa y Solicitud de Recolección</a></li>
            <li><a class="dropdown-item" href="whats.php">Enviar Mensaje por WhatsApp</a></li>
            <li><a class="dropdown-item" href="cita.php">Agendar una Cita</a></li>
            <li><a class="dropdown-item" href="asesoria.php">Asesoría Personalizada</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>

<!-- Botón Login -->
<a href="login.php" id="btnLoginSmall">Iniciar Sesión</a>

<!-- Sección de bienvenida con imagen de fondo -->
<section class="welcome-section">
  <h1>Bienvenido a ZeroWastesScan</h1>
  <p>Plataforma para fomentar el reciclaje y la conciencia ambiental.</p>
</section>

<!-- Productos destacados con imágenes personalizadas -->
<section>
  <h2>Productos Destacados</h2>
  <div class="d-flex flex-wrap justify-content-center">
    <div class="card-custom">
      <img src="cartones.jpeg" alt="Reciclaje de cartón" />
      <h5>Reciclaje de Cartón</h5>
      <p>Recolección y aprovechamiento de cajas de cartón para su reutilización.</p>
    </div>
    <div class="card-custom">
      <img src="botellas.jpeg" alt="Envases de plástico" />
      <h5>Envases de Plástico</h5>
      <p>Botellas y envases reciclables para un segundo uso industrial.</p>
    </div>
    <div class="card-custom">
      <img src="botellas2.jpeg" alt="Reciclaje de botellas" />
      <h5>Reciclaje de Botellas</h5>
      <p>Acopio y reciclaje de botellas PET para reducir la contaminación.</p>
    </div>
  </div>
  
</section>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Footer -->
<footer>
  &copy; <?= date('Y') ?> ZeroWastesScan. Todos los derechos reservados.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>