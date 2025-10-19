<?php
// Crear la conexión a la base de datos usando PDO
$pdo = new PDO('mysql:host=localhost;dbname=discografia;charset=utf8', 'discografia', 'discografia');
// Inicializar un mensaje vacío que luego se mostrará al agregar un disco
$msg = '';
// Comprobar si se ha enviado el formulario mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preparar una sentencia SQL para insertar un nuevo disco en la tabla 'album'
    // Se usan signos de interrogación (?) como marcadores de posición para valores que se pasarán después
    $stmt = $pdo->prepare("INSERT INTO album (titulo, discografica, formato, fechaLanzamiento, fechaCompra, precio) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    // Ejecutar la sentencia pasando los valores recibidos del formulario
    $stmt->execute([
        $_POST['titulo'],          // Título del disco
        $_POST['discografica'],    // Discográfica
        $_POST['formato'],         // Formato (vinilo, CD, DVD, MP3)
        $_POST['fechaLanzamiento'],// Fecha de lanzamiento
        $_POST['fechaCompra'],     // Fecha de compra
        $_POST['precio']           // Precio
    ]);
    // Guardar un mensaje para mostrar que el disco se agregó correctamente
    $msg = "Disco '{$_POST['titulo']}' agregado correctamente.";
}
?>
<!-- Mostrar título principal -->
<h1>Agregar disco</h1>
<!-- Mostrar mensaje de confirmación si existe -->
<?php if($msg) echo "<p>$msg</p>"; ?>
<!-- Formulario para agregar un nuevo disco -->
<form method="post">
    <!-- Campo para el título (obligatorio) -->
    <input name="titulo" placeholder="Título" required>
    <!-- Campo para la discográfica (obligatorio) -->
    <input name="discografica" placeholder="Discográfica" required>
    <!-- Selección del formato del disco -->
    <select name="formato">
        <option value="vinilo">Vinilo</option>
        <option value="cd">CD</option>
        <option value="dvd">DVD</option>
        <option value="mp3">MP3</option>
    </select>
    <!-- Fecha de lanzamiento del disco -->
    <input type="date" name="fechaLanzamiento">
    <!-- Fecha de compra -->
    <input type="date" name="fechaCompra">
    <!-- Precio del disco, con decimales -->
    <input type="number" step="0.01" name="precio" placeholder="Precio">
    <!-- Botón para enviar el formulario -->
    <button type="submit">Agregar</button>
</form>
<!-- Enlace para volver a la página principal de la discografía -->
<p><a href="index.php">Volver a la discografía</a></p>
