<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$archivo = "datos.json";
$radios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevaRadio = [
        "nombre" => $_POST["nombre"],
        "url" => $_POST["url"],
        "logo" => $_POST["logo"],
        "descripcion" => $_POST["descripcion"]
    ];
    $radios[] = $nuevaRadio;
    file_put_contents($archivo, json_encode($radios, JSON_PRETTY_PRINT));
    header("Location: panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Panel Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Panel de Radios</h1>
  <a href="logout.php">Cerrar sesión</a>
  <form method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la radio" required><br>
    <input type="text" name="url" placeholder="URL de streaming" required><br>
    <input type="text" name="logo" placeholder="URL del logo"><br>
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <button type="submit">Guardar</button>
  </form>

  <h2>Radios actuales</h2>
  <ul>
    <?php foreach ($radios as $radio): ?>
      <li>
        <img src="<?= $radio['logo'] ?>" width="50">
        <strong><?= $radio['nombre'] ?></strong> - <?= $radio['url'] ?>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
