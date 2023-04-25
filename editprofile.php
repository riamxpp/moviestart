<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");
  require_once("models/User.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  
  $userData = $userDAO->verifyToken(true);

  $fullName  = $user->getFullName($userData);

  if($userData->img == ""){
    $userData->img = "user.png";
  }

?>
  <div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <h1><?=  $fullName ?></h1>
            <p class="page-description">Altere seus dados no formulário abaixo:</p>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control mt-2" name="name" id="name" placeholder="Digite seu nome" value="<?= $userData->name ?>"  >
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome</label>
              <input type="text" class="form-control mt-2" name="lastname" id="lastname" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>"  >
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" readonly class="form-control mt-2 disabled" name="email" id="email" value="<?= $userData->email ?>"  >
            </div>
            <input type="submit" class="btn card-btn mt-3" value="Alterar">
          </div>
          <div class="col-md-4">
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?><?= $userData->img ?>')"></div>
            <div class="form-group">
              <label for="image">Foto: </label>
              <input type="file" class="form-control-file mt-2" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="bio">Sobre você:</label>
              <textarea class="form-control mt-2" name="bio" id="bio" rows="5" placeholder="Fale sobre você"><?= $userData->bio ?></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="row" id="change-password-container">
      <div class="col-md-4">
        <h2>Alterar a senha</h2>
        <p class="page-description">Digite a nova senha e confirme para alterar sua senha!</p>
        <form action="<?= $BASE_URL ?>user_process.php" method="POST">
          <input type="hidden" name="type" value="changepassword">
          <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control mt-2" name="password" id="password" placeholder="Digite sua senha">
          </div>
          <div class="form-group">
            <label for="confirmpassword">Confirme sua senha:</label>
            <input type="password" class="form-control mt-2" name="confirmpassword" id="confirmpassword" placeholder="Digite sua senha">
          </div>
          <input type="submit" value="Alterar senha" class="btn card-btn mt-2">
        </form>
      </div>
    </div>
  </div>

<?php

  require_once("templates/Footer.php")

?>