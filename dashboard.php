<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");
  require_once("models/User.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  
  $userData = $userDAO->verifyToken(true);

?>

<div id="main-container" class="container-fluid">
  <h2 class="section-title">Dashboard</h2>
  <p class="section-description">
    Adicione ou atulize as informações do seus filmes
  </p>
  <div class="cold-md-12" id="add-movie-container">
    <a href="<?= $BASE_URL ?>newmovie.php" class="btn card-btn">
      <i class="fas fa-plus"></i> Adicionar filme
    </a>
  </div>
  <div class="col-md-2" id="movies-dashboard">
    <table class="table">
      <thead>
        <th scope="col">#</th>
        <th scope="col">Título</th>
        <th scope="col">Nota</th>
        <th scope="col" class="action-column">Ações</th>
      </thead>
      <tbody>
        <tr>
          <td scope="row">#</td>
          <td class="table-movie-title">Título</td>
          <td><i class="fas fa-star">9</i></td>
          <td class="actions-column">
            <a href="#" class="edit-btn">
              <i class="far fa-edit"></i> Editar
            </a>
            <form action="">
              <button type="submit" class="delete-btn">
                <i class="fas fa-time"></i> Deletar
              </button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?php

  require_once("templates/Footer.php");

?>