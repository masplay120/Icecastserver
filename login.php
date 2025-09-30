<?php
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
<!-- resto del HTML igual -->
