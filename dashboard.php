<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");
  require_once("models/User.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);
  
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
        <?php foreach($userMovies as $movie): ?>
          <tr>
            <td scope="row"><?= $movie->id ?></td>
            <td ><a class="table-movie-title" href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id?>"><?= $movie->title ?></a></td>
            <td><i class="fas fa-star">9</i></td>
            <td class="actions-column">
              <a href="<?= $BASE_URL ?>editmovie.php?id=<?= $movie->id?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <form action="<?= $BASE_URL ?>movie_process.php">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $movie->id ?>">
                <button type="submit" class="delete-btn">
                  <i class="fas fa-time"></i> Deletar
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php

  require_once("templates/Footer.php");

?>