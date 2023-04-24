<?php 

  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");
  require_once("models/db.php");
  require_once("models/Message.php");

  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);
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
      if ($password === $confirmpassword) {
        if ($userDAO->findByEmail($email) === false) {
          
          $user = new User();

          // Criação de token e senha;
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($password);

          $user->name = $name;
          $user->lastname = $lastname;
          $user->email = $email;
          $user->password = $finalPassword;
          $user->token = $userToken;

          $auth = true;

          $userDAO->create($user, $auth);

        }else {
          $message->setMessage("O email inserido já esta cadastrado no sistema.", "error", "back");  
        }

      }else {
        $message->setMessage("As senhas não são iguais", "error", "back");
      }
    }else {
      // Enviar mensagem de erro
      $message->setMessage("Por favor preencha todos os campos", "error", "back");
    }

  }else if ($type === "login") {

    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if($userDAO->authenticateUser($email, $password)){
      $message->setMessage("Seja bem-vindo", "success", "editprofile.php");
    }
    else {
      $message->setMessage("Usuário ou senha incorreto!", "error", "back");
    }
  }else {
    
    $message->setMessage("Informações inválidas!", "error", "index.php");

  }