<?php

  require_once("templates/Header.php");
  require_once("dao/UserDAO.php");
  require_once("models/User.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  
  $userData = $userDAO->verifyToken(true);

?>
  <div id="main-container" class="container-fluid d-flex align-items-center justify-content-center">
    <div class="row">
      <div class="col-auto new-movie-container">
        <h1 h1 class="page-title">Adicionar Filme</h1>
        <p class="page-description">Adicione sua crítica.</p>
        <form id="add-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="type" value="create">
          <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu filme">
          </div>
          <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" class="form-control" name="image" id="image" >
          </div>
          <div class="form-group">
            <label for="length">Duração</label>
            <input type="text" class="form-control" name="length" id="length" placeholder="Digite o título do seu filme">
          </div>
          <div class="form-group">
            <label for="category">Categoria</label>
            <select class="form-control" name="category" id="category">
              <option  disabled>Selecione</option> 
              <option value="Comédia">Comédia</option>
              <option value="Terror">Terror</option>
              <option value="Drama">Drama</option>
              <option value="Ação">Ação</option>
              <option value="Romance">Romance</option>
            </select>
          </div>
          <div class="form-group">
            <label for="trailer">Trailer:</label>
            <input type="text" class="form-control" name="triler" id="triler" placeholder="Insira o link do trailer">
          </div>
          <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Descreva o filme"></textarea>
          </div>
          <input type="submit" value="Enviar" class="btn card-btn mt-2  ">
        </form>
      </div>
    </div>
  </div>

<?php

  require_once("templates/Footer.php")

?>