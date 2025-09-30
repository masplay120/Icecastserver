<?php
session_start();

$admin_user = "admin";
$admin_pass = "1234";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["user"] === $admin_user && $_POST["pass"] === $admin_pass) {
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
