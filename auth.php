<?php

  require_once("templates/Header.php");

?>

  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row auth-row">
        <div class="col-md-4" id="login-container">
          <h2>Entrar</h2>
          <form action="" method="POST">
            <input type="hidden" name="type" value="login">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
            </div>
            <input type="submit" class="btn card-btn mt-2" value="Enviar">
          </form>
        </div>
        <div class="col-md-4" id="register-container">
          <h2>Criar conta</h2>
          <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="name" name="name" id="name" class="form-control" placeholder="Nome">
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome</label>
              <input type="lastname" name="namlastname" id="namlastname" class="form-control" placeholder="Sobrenome">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
            </div>
            
            <div class="form-group">
              <label for="confirmpassword">Confirme sua senha</label>
              <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirme sua senha">
            </div>
            <input type="submit" class="btn card-btn mt-2" value="Registrar">
          </form>
        </div>
      </div>
    </div>
  </div>

<?php 

  require_once("templates/Footer.php");

?>