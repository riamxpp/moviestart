<?php 

  require_once("models/Movie.php");
  require_once("models/Message.php");

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

      return $movie;
      
    }

    public function findAll(){

    }

    public function getLatesMovies(){

    }

    public function getMovieByCategory($category){

    }

    public function  getMovieByUserId($id){

    }
    
    public function findById($id) {

    }

    public function findByTitle($title){

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

    }

    public function destroy($id){

    }
  }