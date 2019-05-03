<?php

include "funciones.php";

$errores = [];
$nameOk = "";
$passOk = "";
$emailOk =""; // Para chequear que info estamos mandando dentro de la variable. También podemos usar var_dump dentro de la función validarRegistro() para ver como lo recibe.

if($_POST){
    $errores = validarRegistro($_POST);

    $nameOk = trim($_POST["name"]);
    $passOk = trim ($_POST["pass"]);
    $emailOk = trim($_POST["email"]); //Chequear lógica.

    if (empty($errores)) {
      echo "Usuario Registrado <br><br>";
    }
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registro | Usuario</title>
  </head>
  <body>

      <?php foreach ($errores as $error) {
        echo "$error <br><br>";
      } ?>

    <form class="" action="registro.php" method="POST" enctype="multipart/form-data">
      <label for="nombre">Nombre</label>
      <?php if(isset($errores["name"])): ?>
            <input type="text" id="name" name="name" value="">
          <?php else: ?>
            <input type="text" id="name" name="name" value="<?= $nameOk ?>"> <!-- Revisar lógica: si hay errores debe mostrarse vacío el campo y mostrar el error. -->
          <?php endif; ?>
    <br><br>
      <label for="email">Email</label>
      <?php if(isset($errores["email"])): ?>
        <input type="email" id="email" name="email" value="<?= $emailOk ?>">
      <?php else: ?>
      <input type="email" name="email" value="<?= $emailOk ?>">
    <?php endif; ?>
    <br><br>
      <label for="pasword">Password</label>
          <input type="password" id="pass" class="form-control" placeholder="Password" name="pass" value="">
    <br><br>
    <label for="pass2">Reescribir contraseña</label>
          <input type="password" id="pass2" class="form-control" placeholder="Repita su contraseña" name="pass2" value="">
      <br><br>
      <input type='submit'  value='Enviar' />
    </form>

  </body>
</html>
