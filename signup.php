<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users2 (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      if ($_POST["password"]==$_POST["confirm_password"]){
        $message = 'Usuario creado correctamente';
      }
      
      else{
        $message2 = 'Las contraseñas no coinciden';
      }

    } else {
      $message = 'Lo sentimos, no se puedo crear la cuenta';
    }

  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro de Usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css?v=<%=DateTime.Now%>">
    <link rel="icon" href="assets/imagenes/baños.ico">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
       <div class='registrado' > <p> <?= $message ?></p></div> 
    <?php endif; ?>

    <?php if(!empty($message2)): ?>
       <div class='registrado2' > <p> <?= $message2 ?></p></div> 
    <?php endif; ?>


  <main>
    <div class="contenedor_registro">
      <form action="signup.php" method="POST">
        <h1>Registro de Usuario</h1>
        <span>o <a href="login.php">Iniciar sesión</a></span>
        <input name="email" type="text" placeholder="Ingrese su correo electrónico">
        <input name="password" type="password" placeholder="Ingrese una contraseña">
        <input name="confirm_password" type="password" placeholder="Confirme la contraseña">
        <input type="submit" value="Registrarse">
      </form>
    </div> 
  </main>
  </body>
</html>
