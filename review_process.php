<?php 

  require_once("models/Movie.php");
  require_once("models/db.php");
  require_once("models/Message.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");

  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);

  // Recebendo tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Resgatando dados do usuário;
  $userData = $userDAO->verifyToken();

  if($type === "create"){



  }