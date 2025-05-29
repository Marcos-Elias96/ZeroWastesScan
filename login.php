<?php
session_start();

// Redirigir si ya está logueado
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $users = [
        "admin" => "admin123",
        "user1" => "pass1"
    ];
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $loginError = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión - ZeroWastesScan</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="estilos-globales.css" />

  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: url('recic.jpg') no-repeat center center fixed;
      background-size: cover;
      padding-top: 56px;
    }

    .navbar {
      background-color: #2e7d32 !important;
    }

    .navbar-brand, .nav-link {
      color: #c8e6c9 !important;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 40px;
      max-width: 400px;
      width: 100%;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      color: #fff;
      margin: 100px auto;
    }

    .login-container h1 {
      font-weight: 600;
      margin-bottom: 30px;
      color: white;
    }

    .login-container input.form-control {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: #fff;
    }

    .login-container input::placeholder {
      color: #eee;
    }

    .login-container .btn-success {
      background-color:rgb(22, 39, 134);
      border: none;
      font-weight: bold;
    }

    .login-container .btn-success:hover {
      background-color:rgb(9, 14, 10);
    }

  .login-container {
  background-color: rgba(15, 32, 16, 0.85); /* verde oscuro con transparencia */
  border-radius: 12px;
  padding: 40px;
  max-width: 400px;
  width: 100%;
  color: white;
  margin: 100px auto;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
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

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">ZeroWastesScan</a>
  </div>
</nav>

<!-- Login Form Glass -->
<div class="login-container text-center">
  <h1>Iniciar Sesión</h1>

  <?php if ($loginError): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
  <?php endif; ?>

  <form method="POST">
    <input type="hidden" name="login" value="1" />
    <div class="mb-3 text-start">
      <label class="form-label">Usuario</label>
      <input type="text" name="username" class="form-control" required placeholder="Tu usuario">
    </div>
    <div class="mb-3 text-start">
      <label class="form-label">Contraseña</label>
      <input type="password" name="password" class="form-control" required placeholder="Tu contraseña">
    </div>
    <button type="submit" class="btn btn-success w-100">Entrar</button>
  </form>

  <a href="index.php" class="btn btn-secondary w-100">Volver a la Página Principal</a>
</div>

<footer>
  &copy; <?= date('Y') ?> ZeroWastesScan. Todos los derechos reservados.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>