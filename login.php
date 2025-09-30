<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Leer usuario y contraseña en texto plano
$admin_user = getenv('ADMIN_USER') ?: 'admin';
$admin_pass = getenv('ADMIN_PASS') ?: '1234';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["user"] ?? '';
    $pass = $_POST["pass"] ?? '';

    if ($user === $admin_user && $pass === $admin_pass) {
        $_SESSION["admin"] = true;
        header("Location: panel.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
        // depuración
        echo "<pre>";
        echo "POST: "; var_dump($_POST);
        echo "ENV: "; var_dump($admin_user, $admin_pass);
        echo "</pre>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login Admin</title>
</head>
<body>
  <h1>Login</h1>
  <form method="POST">
    <input type="text" name="user" placeholder="Usuario" required><br>
    <input type="password" name="pass" placeholder="Contraseña" required><br>
    <button type="submit">Entrar</button>
  </form>
</body>
</html>
