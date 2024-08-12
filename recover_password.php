<?php
session_start();
require 'conexion.php';

if (isset($_POST['submit_email'])) {
    $email = $_POST['email'];

    // Buscar el usuario por correo electrónico
    $query = $cnnPDO->prepare('SELECT secret_question FROM usuarios WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['email'] = $email; // Guardar el correo electrónico en la sesión
        $_SESSION['secret_question'] = $user['secret_question']; // Guardar la pregunta secreta en la sesión
        header('Location: recover_password2.php');
        exit;
    } else {
        $error = "Correo electrónico no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Recuperar Contraseña</title>
<style>
  body {
    background-image: url(img/fondo.jpg);
    background-position: center;
    background-repeat: no-repeat; 
    background-size: cover;
    background-attachment: 15px;
    min-height: 100vh;
    background: linear-gradient(rgba(5,7,12,0.75), rgba(5,7,12,0.20)),
    url(img/fondo.jpg) no-repeat center fixed;
    background-size: cover;
    backdrop-filter: blur(3px);   
  }
  .container { 
    max-width: 600px; 
    margin: 20px auto; 
    background: #fff; 
    padding: 20px; 
    border-radius: 8px; 
    box-shadow: 0 0 10px rgba(0,0,0,0.1); 
  }
  h2 { 
    text-align: center; 
    color: #333; 
  }
  .form-group { margin-bottom: 20px; }
  label { display: block; margin-bottom: 8px; color: #666; }
  input[type="text"], input[type="email"] { width: calc(100% - 20px); padding: 10px; font-size: 16px; border: 1px solid #ddd; border-radius: 4px; }
  input[type="submit"] { background-color: #4CAF50; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
  input[type="submit"]:hover { background-color: #45a049; }
</style>
</head>
<body>

<br><br><br><br><br>
<div class="container">
  <h2>Recuperar Contraseña</h2>
  <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
  <form action="" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <button type="submit" name="submit_email" class="btn btn-dark btn-outline-light">Enviar</button>
  </form>
</div>

<br><br><br><br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="login.php" class="btn btn-dark btn-outline-light mx-1">Regresar</a>
</div>
</body>
</html>
