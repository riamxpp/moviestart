<?php 

  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");
  require_once("models/db.php");
  require_once("models/Message.php");

  $message = new Message($BASE_URL);

  $userDAO = new userDAO($conn, $BASE_URL);
  $user = new User();

  $type = filter_input(INPUT_POST, "type");

  if ($type === "update"){

    $userData = $userDAO->verifyToken();

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");
    

    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Upload da imagem;
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
      
      $image = $_FILES["image"];
      $pasta = "img/users";
      $extensao = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
      $imageName = $user->imageGenerateName();

      $final_path = $pasta . "/" . $imageName . "." . $extensao; 

      $verifica_arquivo = move_uploaded_file($image["tmp_name"], $final_path);
      if($verifica_arquivo) {
        $userData->img = $final_path;
        $userDAO->update($userData);
      }

    }

  }else if ($type === "changepassword"){
    
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
    // Confirma que o dado esta sendo enviado pelo usuario logado;
    $id = $userDAO->verifyToken()->id;

    if($password === $confirmpassword) {

      $final_password = $user->generatePassword($password);

      $user->password = $final_password;
      $user->id = $id;

      $userDAO->changePassword($user);

    }else {
      $message->setMessage("As senhas não são iguais!", "error", "back");    
    }

  }else {

    $message->setMessage("Informações inválidas!", "error", "back");  
    
  }