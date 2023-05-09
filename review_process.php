<?php 

  require_once("models/Movie.php");
  require_once("models/db.php");
  require_once("models/Message.php");
  require_once("models/Review.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/UserDAO.php");
  require_once("dao/ReviewDAO.php");
  require_once("globals.php");

  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);
  $reviewDAO = new ReviewDAO($conn, $BASE_URL);

  // Recebendo tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Resgatando dados do usuário;
  $userData = $userDAO->verifyToken();

  if($type === "create"){

    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $movies_id = filter_input(INPUT_POST, "movies_id");

    $reviewObject = new Review();

    // Validando se o filme é existente
    $movieData = $movieDAO->findById($movies_id);

    if ($movieData){
      if(!empty($rating) && !empty($review) && !empty($movies_id)){

        $reviewObject->rating = $rating;
        $reviewObject->review = $review;
        $reviewObject->movies_id = $movies_id;
        $reviewObject->users_id = $userData->id;

        $reviewDAO->create($reviewObject);

      }else {
        $message->setMessage("3 Informações inválidas!", "error", "index.php");
      }
    }else {
     $message->setMessage("2 Informações inválidas!", "error", "index.php");
    }
  }else {
    $message->setMessage("1 Informações inválidas!", "error", "index.php");
  }