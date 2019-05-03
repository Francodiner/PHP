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

  $dominios =['hotmail', 'gmail', 'yahoo'];
  $emailArray = explode('@',$datosFinales["email"]);
  $dominioEscrito = $emailArray[1];//asd.com
  $dominioE = explode('.',$dominioEscrito);
  $dominioSinPunto = $extension[0];
  if(strlen($datosFinales["email"]) == 0){
    $errores["email"] = "Por favor complete el campo email.";
  } elseif (!filter_var($datosFinales["email"], FILTER_VALIDATE_EMAIL)) {
    $errores["email"] = "Por favor ingrese un email con formato válido.";
  }elseif (!in_array($dominioSinPunto,$dominios)) {
        $errores["email"] = "El dominio es invalido";
  }
  $dominiosF =['.com', '.ar'];
  $emailArrayP = explode('.',$datosFinales["email"]);
  $dominioFinal = end($emailArrayP);//com ar
  if (!in_array($dominioFinal,$dominiosF)) {
        $errores["email"] = "El dominio deber terminar en .com o .ar";
  }

  if(strlen($datosFinales["pass"]) <8 ){
    $errores["pass"] = "La contraseña debe tener minimo 8 caracteres";
  } if(strlen($datosFinales["pass2"]) == 0){
    $errores["pass"] = "Por favor repita su contraseña.";
  } elseif($datosFinales["pass"] !== $datosFinales["pass2"]){
    $errores["pass"] = "Las contraseñas no coinciden.";
  }


  return $errores;
}

 ?>
