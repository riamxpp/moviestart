<?php
  require_once("templates/header.php");

  // Verifica se o usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)){
    if(!empty($userData)){
      $id = $userData->id;
    }else {
      $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
  }else {
    $userData = $userDAO->findById($id);

    if(!$userData){
      $message->setMessage("Usuário não encontrado!", "error", "back");
    }
  }

  $fullName = $user->getFullName($userData);

  if($userData->img == ""){
    $userData->img = "user.png";
  }

  // Filmes que o usuário adiciono
  $userMovies = $movieDAO->getMovieByUserId($id);

?>

<div class="container-fluid" id="main-container">
  <div class="col-md-8 offset-md-2 mx-auto">
    <div class="row profile-container">
      <div class="col-md-12 about-container" >
        <h1 class="page-title"><?= $fullName ?></h1>
        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?><?= $userData->img ?>')"></div>
        <h3 class="about-title">Sobre:</h3>
        <?php if(!empty($userData)): ?>
          <p class="profile-description"><?= $userData->bio ?></p>
        <?php else: ?>
          <p class="profile-description">Usuário ainda não escreveu nada...</p>
        <?php endif; ?>
      </div>
      <div class="col-md-12 added-movies-container">
        <?php if (count($userMovies) > 0): ?>
          <h3>Filmes que enviou:</h3>
        <?php endif; ?>
        <div class="col-md-12 movies-container">
          <?php foreach($userMovies as $movie):  ?>
            <?php require("templates/MovieCard.php"); ?>
          <?php endforeach; ?>
          <?php if(count($userMovies) === 0): ?>
            <p class="empty-list">O usuário ainda não enviou filmes.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
  require_once("templates/Footer.php");
?>