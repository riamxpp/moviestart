<?php 

  require_once("models/Movie.php");
  require_once("models/db.php");
  require_once("models/Message.php");
  require_once("dao/MovieDAO.php");
  require_once("dao/UserDAO.php");
  require_once("globals.php");

  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  $userData = $userDAO->verifyToken();

  if ($type === "create"){

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $category = filter_input(INPUT_POST, "category");
    $trailer = filter_input(INPUT_POST, "trailer");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie();

    if(!empty($title) && !empty($description) && !empty($category)){
      $movie->title = $title;
      $movie->description = $description;
      $movie->category = $category;
      $movie->trailer = $trailer;
      $movie->length = $length;
      $movie->users_id = $userData->id;

      
      if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
        $image = $_FILES["image"];
        
        // retira a extensão da img, ex: jpg, jpeg, png...
        $extensao = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        if ($extensao === "jpg" || $extensao === "png" || $extensao === "jpeg") {
          $pasta = "img/movies";
          $imageName = $userData->imageGenerateName();
          
          //move um arquivo enviado através de um formulário de upload para um diretório específico no servidor
          $final_path = $pasta . "/" .$imageName;
          $verificaImage = move_uploaded_file($image["tmp_name"], $final_path);
          if($verificaImage){
            $movie->img = $final_path;
          }else {
            $message->setMessage("Algo deu errado ao subir a imagem!", "error", "back");
          }
        }else {
          $message->setMessage("Tipo de arquivo inválido!", "error", "back");
        }
      }else {
        $message->setMessage("Envia uma foto valida!", "error", "back");
      }

      $movieDAO->create($movie);  
      $message->setMessage("Filme inserido com sucesso!", "success", "back");
    }else {
      $message->setMessage("Seu filme precisa de título, descrição e no mínimo uma categoria!", "error", "back");  
    }
  }else {
    $message->setMessage("Inválido!", "error", "back");
  }