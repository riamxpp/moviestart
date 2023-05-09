<?php

  require_once("templates/Header.php");
  // verificando se o usuário esta logado
  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/ReviewDAO.php");

  // pega o id do filme
  $id = filter_input(INPUT_GET, "id");


  $movie;

  $movieDao = new MovieDAO($conn, $BASE_URL);
  $reviewDao = new ReviewDAO($conn, $BASE_URL);

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

  if (empty($movie->img)){
    $movie->img = " img/movies/movie_cover.jpg";
  }

  $alreadyReviewd = false;

  $moviesReviews = $reviewDao->getMoviesReview($movie->id);

  var_dump($movie)
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
    <div class="col-md-4">
      <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?><?= $movie->img ?>')">
      </div>
    </div>
    <div class="offset-md-1 col-md-8" id="reviews-container">
      <h3 id="reviews-title">Avaliações: </h3>
      <!-- verificando se habilito reviw para o usuário -->
      <?php if(!empty($userData && !$userOwnsMovie && !$alreadyReviewd)): ?>
        <div class="col-md-12" id="review-form-container">
        <h4>Envie sua avaliação: </h4>
        <p class="page-description">
          Preencha o formulário com a nota e comentário sobre o filme
        </p>
        <form id="review-form" action="<?= $BASE_URL ?>review_process.php" method="POST">
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="movies_id" value="<?=$movie->id?>">
          <div class="form-group">
            <label for="rating">Nota do filme</label>
            <select name="rating" id="rating" class="form-control">
              <option value="">Selecione</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="9">9</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="form-group">
            <label for="review">Seu comentário</label>
            <textarea class="form-control" name="review" id="review" rows="3" placeholder="O que você achou do filme ?"></textarea>
          </div>
          <input type="submit" class="btn card-btn mt-2" value="Enviar comentário">
        </form>
      </div>
      <?php endif; ?>
      <?php foreach($moviesReviews as $review): ?>
        <?php require_once("templates/Review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($moviesReviews) === 0): ?>
        <p class="empty-list">Não há comentários para esse filme ainda.</p>
      <?php endif; ?>
    </div>
  </div>
</div>


<?php 

  require_once("templates/Footer.php");

?>