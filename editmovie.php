<?php 

  require_once("templates/Header.php");
  // verificando se o usuário esta logado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $userData = $userDAO->verifyToken(true);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)){
    $message->setMessage("O filme não foi encontrado!", "error", "index.php");
  }else {
    $movie = $movieDAO->findById($id);
    if(!$movie){
      $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    }else {
      
    }
  }

  if($movie->img == ""){
    $movie->img = "movie_cover.jpg";
  }

?>

<div class="container-fluid" id="main-container">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6 offset-md-1">
        <h1><?= $movie->title ?></h1>
        <p class="page-description">Altere os dados do filme no formulárioa abaixo: </p>
        <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="type" value="update">
          <input type="hidden" name="id" value="<?= $movie->id ?>">
            <div class="form-group">
              <label for="title">Título</label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Digite o título do seu filme" value="<?= $movie->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem</label>
              <input type="file" class="form-control" name="image" id="image" >
            </div>
            <div class="form-group">
              <label for="length">Duração</label>
              <input type="text" class="form-control" name="length" id="length" placeholder="Digite o título do seu filme" value="<?= $movie->length ?>">
            </div>
            <div class="form-group">
              <label for="category">Categoria</label>
              <select class="form-control" name="category" id="category">
                <option  disabled>Selecione</option> 
                <option value="Comédia" <?= $movie->category === "Comédia"? "selected" : "" ?> >Comédia</option>
                <option value="Terror" <?= $movie->category === "Terror"? "selected" : "" ?>>Terror</option>
                <option value="Drama" <?= $movie->category === "Drama"? "selected" : "" ?>>Drama</option>
                <option value="Ação" <?= $movie->category === "Ação"? "selected" : "" ?>>Ação</option>
                <option value="Romance" <?= $movie->category === "Romance"? "selected" : "" ?>>Romance</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" value="<?= $movie->trailer ?>" class="form-control" name="trailer" id="triler" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" class="form-control" rows="5" placeholder="Descreva o filme"><?= $movie->description ?></textarea>
            </div>
            <input type="submit" value="Editar filme" class="btn card-btn mt-2  ">
        </form>
      </div>
      <div class="col-md-3">
        <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?><?= $movie->img ?>')"></div>
      </div>
    </div>
  </div>
</div>

<?php 

  require_once("templates/Footer.php");

?>