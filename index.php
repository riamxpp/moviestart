<?php

  require_once("templates/Header.php");
  require_once("dao/MovieDAO.php");

  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $laterMovies = $movieDAO->getLatesMovies();
  $actionMovies = $movieDAO->getMovieByCategory('Ação');
  $comedyMovies = $movieDAO->getMovieByCategory('Comédia');

  // var_dump($laterMovies);
  // print_r($laterMovies);

  // foreach ($laterMovies as $movie) {
    // var_dump($actionMovies);
  //   echo "------------------ <br>";
  // }

?>
<div id="main-container" class="container-fluid">
    <div class="movies-container">
      <h2 class="section-title">Filmes novos</h2>
      <p class="section-description">Veja as críticas do últimos filmes adicionados no MovieStart</p>
      <div class="wrapper-movies">
        <?php foreach($laterMovies as $movie): ?>
         <?php require_once("templates/MovieCard.php") ?>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="movies-container">
      <h2 class="section-title">Ação</h2>
      <?php if(count($actionMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrado</p>
      <?php else: ?>
        <p class="section-description">Veja os melhores filmes de ação</p>
        <?php foreach($actionMovies as $movie): ?>
          <?php require_once("templates/MovieCard.php") ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="movies-container">
      <h2 class="section-title">Comédia</h2>
      <?php foreach($comedyMovies as $movie): ?>
        <?php require_once("templates/MovieCard.php") ?>
      <?php endforeach; ?>

      <?php if(count($comedyMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrado</p>
      <?php else: ?>
        <p class="section-description">Veja os melhores filmes de comédia</p>
        <?php foreach($actionMovies as $movie): ?>
          <?php require_once("templates/MovieCard.php") ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
<?php

  require_once("templates/Footer.php")

?>