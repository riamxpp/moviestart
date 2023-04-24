<?php 

  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");
  require_once("models/db.php");
  require_once("models/Message.php");

  $message = new Message($BASE_URL);

  // Verifica o tipo de formulario
  $type = filter_input(INPUT_POST, "type");

  // verificação do tipo de formulario
  if ($type === "register"){

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    if ($name && $lastname && $email && $password){



    }else {
      // Enviar mensagem de erro
      $message->setMessage("Por favor preencha todos os campos", "error", "back");
    }

  }else if ($type === "login") {}