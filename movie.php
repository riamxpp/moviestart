<?php

  require_once("templates/Header.php");
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
  }

  #checa se o filme é do usuário
  $userOwnsMovie = false;

  if(!empty($userData)){
    if ($userData->id === $movie->users_id){
      $userOwnsMovie = true; 
    }
  }
  // Trocando o 'watch' do link do trailer por 'embed'
  $newTrailer;
  if(!empty($movie->trailer)){
    $newTrailer = str_replace("watch", "embed", $movie->trailer);
  }
?>

<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="off-set-md-1 col-md-6 movie-container">
      <h1 class="page-title">Movie Title</h1>
      <p class="movie-details">
        <span>Duração: <?= $movie->length ?></span>
        <span class="pipe"></span>
        <span>Categoria: <?= $movie->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> 9</span>
      </p>
      <iframe src="<?= $newTrailer ? $newTrailer : $movie->trailer ?>" title="<?= $movie->title?> trailer" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
      </iframe>
      <p><?= $movie->description ?></p>
    </div>
  </div>
</div>


<?php 

  require_once("templates/Footer.php");

?>