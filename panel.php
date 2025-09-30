<?php
session_start();
if(!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$archivo = "mounts.json";
$archivo_txt = "mounts.txt";
$radios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $mount = $_POST["mount"];
    $pass = $_POST["source_password"];

    // Guardar en JSON
    $radios[] = ["mount"=>$mount,"source_password"=>$pass];
    file_put_contents($archivo, json_encode($radios, JSON_PRETTY_PRINT));

    // Guardar en mounts.txt para Icecast
    $txt = "";
    foreach($radios as $r) {
        $txt .= $r["mount"].":".$r["source_password"]."\n";
    }
    file_put_contents($archivo_txt, $txt);

    header("Location: panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Panel Admin Radios</title></head>
<body>
<h1>Crear nueva radio</h1>
<form method="POST">
<input type="text" name="mount" placeholder="Nombre del mount (/microradio)" required><br>
<input type="text" name="source_password" placeholder="Contraseña de transmisión" required><br>
<button type="submit">Crear Radio</button>
</form>

<h2>Radios existentes</h2>
<ul>
<?php foreach($radios as $r): ?>
<li><?=htmlspecialchars($r['mount'])?> - <?=htmlspecialchars($r['source_password'])?></li>
<?php endforeach; ?>
</ul>
</body>
</html>
