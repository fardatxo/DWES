<?php
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');

if ($_POST) {
    $u = trim($_POST['user'] ?? '');
    $p = $_POST['password'] ?? '';

    if (!$u || !$p) {
        $msg = "Rellena todos los campos.";
    } else {
        $q = $pdo->prepare("SELECT 1 FROM tabla_usuarios WHERE usuario=?");
        $q->execute([$u]);
        
        if ($q->fetch()) {
            $msg = "El usuario ya existe.";
    } else {
        $imgBig = $imgSmall = null;
        
        // Procesar imagen si existe
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tipo = mime_content_type($_FILES['imagen']['tmp_name']);
            
            if ($tipo != 'image/png' && $tipo != 'image/jpeg') {
                $msg = "Solo PNG o JPG.";
            } else {
                list($w, $h) = getimagesize($_FILES['imagen']['tmp_name']);
                
                if ($w > 360 || $h > 480) {
                    $msg = "Imagen muy grande (máx 360x480px).";
                } else {
                    $dir = "img/users/$u";
                    if (!is_dir($dir)) mkdir($dir, 0755, true);
                    
                    $ext = ($tipo == 'image/png') ? 'png' : 'jpg';
                    $src = ($tipo == 'image/png') ? imagecreatefrompng($_FILES['imagen']['tmp_name']) : imagecreatefromjpeg($_FILES['imagen']['tmp_name']);
                    
                    // Versión grande
                    $big = imagescale($src, (int)min($w, 360 * $w / max($w, $h * 360 / 480)));
                    ($ext == 'png') ? imagepng($big, "$dir/{$u}Big.$ext") : imagejpeg($big, "$dir/{$u}Big.$ext", 90);
                    
                    // Versión pequeña
                    $small = imagescale($src, (int)min($w, 72 * $w / max($w, $h * 72 / 96)));
                    ($ext == 'png') ? imagepng($small, "$dir/{$u}Small.$ext") : imagejpeg($small, "$dir/{$u}Small.$ext", 90);
                    
                    imagedestroy($src);
                    imagedestroy($big);
                    imagedestroy($small);
                    
                    $imgBig = "$dir/{$u}Big.$ext";
                    $imgSmall = "$dir/{$u}Small.$ext";
                }
            }
        }
        
        if (!isset($msg)) {
            $pdo->prepare("INSERT INTO tabla_usuarios (usuario, password, imagen_big, imagen_small) VALUES (?, ?, ?, ?)")
                ->execute([$u, password_hash($p, PASSWORD_DEFAULT), $imgBig, $imgSmall]);
            $msg = "Usuario creado. <a href='login.php'>Iniciar sesión</a>";
        }
    }
}
?>

<h2>Crear usuario</h2>

<form method="post" enctype="multipart/form-data">
  Usuario: <input name="user" required><br>
  Contraseña: <input type="password" name="password" required><br>
  Imagen: <input type="file" name="imagen" accept="image/png, image/jpeg"><br><br>
  <button>Registrar</button>
</form>

<p><?= $msg ?? '' ?></p>