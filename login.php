<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-BañosUNMSM');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users2 WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-BañosUNMSM");
    } else {
      $message = 'Lo sentimos, los datos del usuario son incorrectos';
    }

    echo "<div class='error'> <p> $message </p> </div>";
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inicio de Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css?v=<%=DateTime.Now%>">
    <link rel="icon" href="assets/imagenes/baños.ico">
  </head>
  <body>
      <?php require 'partials/header.php' ?>
    <main>
      <div class="contenedor_login">
        <?php if(!empty($message)): ?>
        <p> <?= $message ?> </p>
        <?php endif; ?>

        <form action="login.php" method="POST">
          <h1>BañosUNMSM</h1>
          <input name="email" type="text" placeholder="Correo electrónico">
          <input name="password" type="password" placeholder="Contraseña">
          <input type="submit" value="Ingresar"> <hr>
          <span>o <a href="signup.php">Registrarse</a></span>
        </form>     
      </div>
    </main>
  </body>
</html>
