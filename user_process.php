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
    
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    $userDAO->update($userData);

  }else if ($type === "changepassword"){

  }else {
    $message->setMessage("Informações inválidas!", "error", "back");  
  }