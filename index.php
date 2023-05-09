<?php

  require_once("templates/Header.php");
  require_once("dao/MovieDAO.php");

  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $laterMovies = $movieDAO->getLatesMovies();
  $actionMovies = $movieDAO->getMovieByCategory('Ação');
  $comedyMovies = $movieDAO->getMovieByCategory('Comédia');

?>
<div id="main-container" class="container-fluid">
    <div class="movies-container">
      <h2 class="section-title">Filmes novos</h2>
      <p class="section-description">Veja as críticas do últimos filmes adicionados no MovieStart</p>
      <div class="wrapper-movies">
        <?php foreach($laterMovies as $movie): ?>
          <div class="card movie-card"> 
            <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?><?= $movie->img ?>')"></div>
            <div class="card-body">
              <p class="card-rating">
                <i class="fas fa-star"></i>
                <span class="rating">9</span>
              </p>
              <h5 class="card-title">
                <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
              </h5>
              <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
              <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Conhecer</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="movies-container">
      <h2 class="section-title">Ação</h2>
      <?php if(count($actionMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrado</p>
      <?php else: ?>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <div class="movies-category-container">
          <?php foreach($actionMovies as $movie): ?>
            <?php require("templates/MovieCard.php"); ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="movies-container">
      <h2 class="section-title">Comédia</h2>
      <div class="movies-category-container">
        <?php foreach($comedyMovies as $movie): ?>
          <?php require_once("templates/MovieCard.php") ?>
        <?php endforeach; ?>
      </div>

      <?php if(count($comedyMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrado</p>
      <?php else: ?>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <?php foreach($actionMovies as $movie): ?>
          <div class="card movie-card">
            <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?><?= $movie->img ?>')"></div>
            <div class="card-body">
              <p class="card-rating">
                <i class="fas fa-star"></i>
                <span class="rating">9</span>
              </p>
              <h5 class="card-title">
                <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
              </h5>
              <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
              <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Conhecer</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
<?php

  require_once("templates/Footer.php")

?>