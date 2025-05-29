<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Enviar WhatsApp - ZeroWastesScan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #25D366; /* Verde WhatsApp */
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      text-align: center;
      padding: 20px;
    }
    .container {
      background: rgba(0, 0, 0, 0.2);
      border-radius: 20px;
      padding: 40px 30px;
      max-width: 400px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    h1 {
      margin-bottom: 20px;
      font-weight: 700;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    }
    .btn-success {
      background-color: #075E54;
      border: none;
      font-weight: 600;
      font-size: 1.1rem;
      padding: 12px 25px;
      border-radius: 50px;
      transition: background-color 0.3s ease;
    }
    .btn-success:hover {
      background-color: #128C7E;
    }
    .btn-secondary {
      margin-top: 20px;
      border-radius: 50px;
      padding: 10px 20px;
      font-weight: 600;
      background-color: rgba(255,255,255,0.3);
      border: none;
      color: white;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
      background-color: rgba(255,255,255,0.6);
      color: #075E54;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Enviar Mensaje por WhatsApp</h1>
    <p>Haz clic en el botón para enviar un mensaje predefinido por WhatsApp.</p>

    <?php
    $numeroWhatsApp = "5618825692"; // Número con código país México
    $mensajeWhatsApp = urlencode("Hola, quiero reciclar este producto.");
    $urlWhatsApp = "https://api.whatsapp.com/send?phone={$numeroWhatsApp}&text={$mensajeWhatsApp}";
    ?>

    <a href="<?= htmlspecialchars($urlWhatsApp) ?>" target="_blank" class="btn btn-success">Enviar mensaje por WhatsApp</a>

    <br />
    <a href="index.php" class="btn btn-secondary">Atras</a>
  </div>
</body>
</html>