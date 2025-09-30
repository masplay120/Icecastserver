<?php
$radios = file_exists("datos.json") ? json_decode(file_get_contents("datos.json"), true) : [];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Radios Online</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Escucha nuestras radios</h1>
  <?php foreach ($radios as $radio): ?>
    <div class="card">
      <img src="<?= $radio['logo'] ?>" width="100"><br>
      <h2><?= $radio['nombre'] ?></h2>
      <p><?= $radio['descripcion'] ?></p>
      <audio controls>
        <source src="<?= $radio['url'] ?>" type="audio/mpeg">
      </audio>
    </div>
  <?php endforeach; ?>
</body>
</html>
