<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PRESENTACIÓN</title>
</head>
<body>
  <?php include('cabecera.inc.php'); ?>

  <h5>
    Tengo 18 años, estoy ahora mismo estudiando el 2 año del Grado Superior de Desarrollo de Aplicaciones Web, mi
    objetivo es tener el título de Técnico Superior <br>de DAW y seguidamente hacer el 2 año de DAM.
    Al sacarme estos títulos quiero intentar ir a trabajar fuera, quizás Suiza, Australia o Nueva Zelanda.
  </h5>

  <img src="img/images-3.jpeg" alt="Perro wasa">

  <nav>
    <h4><a href="mailto:adrmorgon@alu.edu.gva.es">Enviar correo</a></h4>
    <h5><a href="tecnologias.php">TECNOLOGIAS</a></h5>
    <h5><a href="rrss.php">RRSS</a></h5>
  </nav>

  <hr>

  <section>
    <h3>Formulario de Contacto</h3>
    <form action="mailto:adrmorgon@alu.edu.gva.es" method="post" enctype="text/plain">
      <label for="nombre">Nombre:</label><br>
      <input type="text" id="nombre" name="nombre" required><br><br>

      <label for="email">Correo electrónico:</label><br>
      <input type="email" id="email" name="email" required><br><br>

      <label for="mensaje">Mensaje:</label><br>
      <textarea id="mensaje" name="mensaje" rows="5" required></textarea><br><br>

      <button type="submit">Enviar</button>
      <button type="reset">Limpiar</button>
    </form>
  </section>

</body>
</html>