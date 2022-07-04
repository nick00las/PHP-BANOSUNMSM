<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password  FROM users2 WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BañosUNMSM </title>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css?v=<%=DateTime.Now%>">
    <link rel="icon" href="assets/imagenes/baños.ico">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <div class="mensaje">
      <?php if(!empty($user)): ?>
        <br> Bienvenido. <?= $user['email']; ?>
        <br>Has ingresado satisfactoriamente 
        <br>
        <a href="logout.php">
          Cerrar sesión
        </a>
      <?php else: ?>
        <h2>Sea bienvenid@ a Baños UNMSM</h2>
        <img src="assets/imagenes/foro.png" alt="foro" class="foro">
        <a href="login.php">Ingresar</a> o
        <a href="signup.php">Registrarse</a>
      <?php endif; ?>
    </div>
  </body>
</html>
