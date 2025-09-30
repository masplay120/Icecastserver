<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php'; // carga $admin_user y $admin_pass_hash

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["user"] ?? '';
    $pass = $_POST["pass"] ?? '';

    if ($user === $admin_user && password_verify($pass, $admin_pass_hash)) {
        $_SESSION["admin"] = true;
        header("Location: panel.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Login</h1>
  <form method="POST">
    <input type="text" name="user" placeholder="Usuario" required><br>
    <input type="password" name="pass" placeholder="Contraseña" required><br>
    <button type="submit">Entrar</button>
  </form>
  <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>
</body>
</html>
