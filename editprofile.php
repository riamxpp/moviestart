<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");

  $userDAO = new UserDAO($conn, $BASE_URL);
  $userData = $userDAO->verifyToken(true);

?>
  <div id="main-container" class="container-fluid">
    <h1>Edição de perfil</h1>
  </div>

<?php

  require_once("templates/Footer.php")

?>