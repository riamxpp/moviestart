<?php 

  require_once("models/Movie.php");
  require_once("models/Message.php");

  require_once("dao/ReviewDAO.php");

  class MovieDAO implements MovieInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildMovie($data){

      $movie = new Movie();   
      $movie->id = $data["id"]; 
      $movie->title = $data["title"];  
      $movie->description = $data["description"];  
      $movie->img = $data["img"];  
      $movie->trailer = $data["trailer"];  
      $movie->category = $data["category"];
      $movie->length = $data["length"];    
      $movie->users_id = $data["users_id"];  

      // Recebe as rating do filme;
      $reviewDao = new ReviewDAO($this->conn, $this->url);

      $rating = $reviewDao->getRatings($movie->id);
      $movie->rating = $rating;

      return $movie;
      
    }

    public function findAll(){
      $movies = [];

      $stmt = $this->conn->query("SELECT * FROM movies");

      $stmt->execute();
    
      if ($stmt->rowCount() > 0){
        $allMovies = $stmt->fetchAll();

        foreach($allMovies as $movie) {
          $movies[] = $this->buildMovie($movie);
        }
      }

      return $movies; 
    }

    public function getLatesMovies(){

      $movies = [];

      $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");

      $stmt->execute();

      if($stmt->rowCount() > 0){

        $allMovies = $stmt->fetchAll();

        foreach($allMovies as $movie) {
          $movies[] = $this->buildMovie($movie);
        }

      }

      return $movies;

    }

    public function getMovieByCategory($category){
      
      $movies = [];

      $stmt = $this->conn->prepare("SELECT * FROM movies 
                                    WHERE category = :category 
                                    ORDER BY id DESC");
                                    
      $stmt->bindParam(":category", $category);

      $stmt->execute();

      if($stmt->rowCount() > 0){

        $allMovies = $stmt->fetchAll();

        foreach($allMovies as $movie){
          $movies[] = $this->buildMovie($movie);
        }

      }

      return $movies;

    }

    public function getMovieByUserId($id){
      $movies = [];
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :id");

      $stmt->bindparam(":id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {
        $allMovies = $stmt->fetchAll();

        foreach($allMovies as $movie){
          $movies[] = $this->buildMovie($movie);
        }
      }

      return $movies;
    }
    
    public function findById($id) {
      $movie = [];
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = :id");

      $stmt->bindparam(":id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0){
        $movieData = $stmt->fetch();

        $movie = $this->buildMovie($movieData);

        return $movie;
      }else {
        return false;
      }
    }

    public function findByTitle($title){
      $movies = [];

      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE title = :title");

      $stmt->bindparam(":title", $title);
    
      $stmt->execute();

      if($stmt->rowCount() > 0) {
        $allMovies = $stmt->fetchAll();

        foreach($allMovies as $movie){
          $movies[] = $this->buildMovie($movie);
        }
      }

      return $movies;
    }

    public function create(Movie $movie){

      $stmt = $this->conn->prepare("INSERT INTO movies (
        title, description, img, trailer, category, length, users_id)
        VALUES (
          :title, :description, :img, :trailer, :category, :length, :users_id
        )");

      $stmt->bindParam(":title", $movie->title);
      $stmt->bindParam(":description", $movie->description);
      $stmt->bindParam(":img", $movie->img);
      $stmt->bindParam(":trailer", $movie->trailer);
      $stmt->bindParam(":category", $movie->category);
      $stmt->bindParam(":length", $movie->length);
      $stmt->bindParam(":users_id", $movie->users_id);

      $stmt->execute();
    }

    public function update(Movie $movie){
      $stmt = $this->conn->prepare("UPDATE movies SET 
                                    title = :title, 
                                    description = :description, 
                                    img = :img, 
                                    trailer = :trailer, 
                                    category = :category, 
                                    length = :length
                                    WHERE id = :id");
      print_r($movie);
      $stmt->bindParam(":title", $movie->title);  
      $stmt->bindParam(":description", $movie->description);  
      $stmt->bindParam(":img", $movie->img);  
      $stmt->bindParam(":trailer", $movie->trailer);  
      $stmt->bindParam(":category", $movie->category);  
      $stmt->bindParam(":length", $movie->length);  
      $stmt->bindParam(":id", $movie->id);

      $stmt->execute();

      $this->message->setMessage("Filme atualizado com sucesso!", "success", "index.php");
    }

    public function destroy($id){
      $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");

      $stmt->bindparam(":id", $id);

      $stmt->execute();

      $this->message->setMessage("Filme removido com sucesso!", "success", "dashboard.php");
    }
  }