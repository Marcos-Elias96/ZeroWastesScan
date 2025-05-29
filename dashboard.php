<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - ZeroWastesScan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="#">ZeroWastesScan</a>
        <div class="ms-auto text-white">
            Usuario: <?= htmlspecialchars($_SESSION['username']) ?>
            <a href="logout.php" class="btn btn-danger btn-sm ms-3">Cerrar sesión</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <h1>Panel de Control</h1>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></p>

    <div class="list-group">
        <a href="clientes.php" class="list-group-item list-group-item-action">Gestionar Clientes</a>
        <a href="productos.php" class="list-group-item list-group-item-action">Gestionar Productos</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>