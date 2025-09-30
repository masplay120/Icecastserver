<?php
session_start();
if(!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$archivo = "mounts.json";
$radios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $mount = $_POST["mount"];
    $pass = $_POST["source_password"];

    // Guardar en JSON
    $radios[] = ["mount"=>$mount,"source_password"=>$pass];
    file_put_contents($archivo, json_encode($radios, JSON_PRETTY_PRINT));

    // Crear icecast.xml dinámicamente
    $template = file_get_contents("icecast.xml"); // template base
    $mountsXml = "";
    foreach($radios as $r) {
        $mountsXml .= "<mount>\n<mount-name>{$r['mount']}</mount-name>\n<password>{$r['source_password']}</password>\n</mount>\n";
    }
    // Insertamos mounts antes del cierre </icecast>
    $newXml = str_replace("</icecast>", $mountsXml . "</icecast>", $template);
    file_put_contents("/etc/icecast2/icecast.xml", $newXml);

    // Reiniciar Icecast
    exec("pkill icecast2");  // mata el proceso actual
    exec("icecast2 -c /etc/icecast2/icecast.xml -b"); // lo reinicia en background

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
