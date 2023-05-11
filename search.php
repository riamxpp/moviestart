<?php

  require_once("templates/Header.php");
  require_once("dao/MovieDAO.php");

  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $q = filter_input(INPUT_GET, "q");

  $movies = $movieDAO->findByTitle($q);

?>
<div id="main-container" class="container-fluid">
    <div class="movies-container">
      <h2 class="section-title" id="search-title">Sua busca: <span id="search-result"><?= $q ?></span></h2>
      <p class="section-description">Resultado da busca:</p>
      <div class="wrapper-movies">
        <?php foreach($movies as $movie): ?>
          <?php require("templates/MovieCard.php") ?>
        <?php endforeach; ?>
        <?php if (count($movies) === 0): ?>
          <p class="empty-list">Não há filmes para esta busca, <a class="back-link" href="<?= $BASE_URL?>index.php">Voltar</a>!</p>
        <?php endif; ?>
      </div>
    </div>

  </div>
<?php

  require_once("templates/Footer.php")

?>