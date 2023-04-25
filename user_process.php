<?php 

  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");
  require_once("models/db.php");
  require_once("models/Message.php");

  $message = new Message($BASE_URL);

  $userDAO = new userDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  if ($type === "update"){

    $userData = $userDAO->verifyToken();

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");
    
    $user = new User();

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

  }else {

    $message->setMessage("Informações inválidas!", "error", "back");  
    
  }