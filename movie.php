<?php

  require_once("templates/header.php");
  // verificando se o usuário esta logado
  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");

  // pega o id do filme
  $id = filter_input(INPUT_GET, "id");


  $movie;

  $movieDao = new MovieDAO($conn, $BASE_URL);

  if(empty($id)){
    $message->setMessage("O filme não foi encontrado", "error", "index.php");
  }else {
    $movie = $movieDao->findById($id);
    var_dump($movie);
  }

  #checa se o filme é do usuário
  $userOwnsMovie = false;

  if(!empty($userData)){
    if ($userData->id === $movie->users_id){
      $userOwnsMovie = true; 
    }
  }


?>