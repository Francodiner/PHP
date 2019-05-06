<?php
function validarRegistro($datos){
  $errores=[];
  $datosFinales = [];
  foreach ($datos as $posicion => $valores) {
    if(!is_array($datos[$posicion])){
      $datosFinales[$posicion] = trim($valores);
    }
  }
  if(strlen($datosFinales["name"]) == 0){
    $errores["name"] = "Por favor complete el campo nombre.";
  } elseif(ctype_alpha($datosFinales["name"]) == false){
    $errores["name"] = "El nombre debe contener solo letras";
  }
  if(strlen($datosFinales["username"]) == 0){
    $errores["username"] = "Por favor complete el campo Usuario.";
  } elseif(ctype_alpha($datosFinales["name"]) == false){
    $errores["username"] = "El nombre debe contener solo letras";
  }
  if(strlen($datosFinales["email"]) == 0){
      $errores["email"] = "Por favor complete el campo email.";
    } elseif (!filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL)) {
      $errores["email"] = "Por favor ingrese un email con formato válido.";
    }

  if(strlen($datosFinales["password"]) <8 ){
    $errores["password"] = "La contraseña debe tener minimo 8 caracteres";
  }

  return $errores;
}
function nextId(){
  // TODO: que pasa si no hay usuario anterior.
  if (!file_exists("usuarios.json")) {
    $json = '';
  }else {
    $json = file_get_contents("usuarios.json");
  }
  if ($json == '') {
    return 1;
  }
  $array = json_decode($json, true);
  $ultimoUsuario = array_pop($array["usuarios"]);
  $lastId = $ultimoUsuario["id"];
  return $lastId + 1;
}

function armarUsuario(){//Se pasa por $_POST
  return  [
    "id" => nextId(),
    "nombre" => trim($_POST["name"]),
    "email" =>  trim($_POST["email"]),
    "username" => trim($_POST["username"]),
    "password" => password_hash($_POST["password"],PASSWORD_DEFAULT),
    "foto" => "img/".$_POST["username"]
  ];
}
function guardarUsuario($usuario){
  // TODO: que pasa si no hay archivo.
  if (!file_exists("usuarios.json")) {
    $json = '';
  }else {
    $json = file_get_contents("usuarios.json");
  }
//  $json = file_get_contents("usuarios.json");
  $array = json_decode($json, true);
  $array["usuarios"][] = $usuario;
  $array = json_encode($array, JSON_PRETTY_PRINT);
  file_put_contents("usuarios.json", $array);
}
function buscarUsuarioPorUsername($user){
  $json = file_get_contents("db.json");
  $array = json_decode($json, true);

  foreach($array["usuarios"] as $usuario){
    if($usuario["username"] == $user){
      return $usuario;
    }
}
return null;
}
 ?>
