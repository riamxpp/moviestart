<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");
  require_once("models/User.php");

  $userDAO = new UserDAO($conn, $BASE_URL);
  $userData = $userDAO->verifyToken(true);
  $user = new User();
  $fullName  = $user->getFullName($userData);

  if($userData->img == ""){
    $userData->img = "user.png";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <h1><?=  $fullName ?></h1>
            <p class="page-description">Altere seus dados no formulário abaixo:</p>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Digite seu nome" value="<?= $userData->name ?>"  >
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome</label>
              <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>"  >
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" readonly class="form-control disabled" name="email" id="email" value="<?= $userData->email ?>"  >
            </div>
            <input type="submit" class="btn form-btn" value="Alterar">
          </div>
          <div class="col-md-4">
            <div id="profile-image-container" style="background-image: url(<?= $BASE_URL ?>img/users/<?= $userData->img ?>)"></div>
            <div class="form-group">
              <label for="image">Foto: </label>
              <input type="file" class="form-control-file" name="image" id="image" value="<?= $userData->img ?>"  >
            </div>
            <div class="form-group">
              <label for="bio">Sobre você:</label>
              <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Fale sobre você"><?= $userData->bio ?></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

<?php

  require_once("templates/Footer.php")

?>