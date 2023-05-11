<?php

  require_once("models/Review.php");
  require_once("models/Message.php");

  require_once("dao/UserDAO.php");

  class ReviewDAO implements ReviewInterface {
    private $conn;
    private $url;
    private $message;
    
    public function __construct(PDO $conn, $url){
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    } 

    public function buildReview($data){
      $reviewObject = new Review();

      $reviewObject->id = $data["id"];
      $reviewObject->rating = $data["rating"];
      $reviewObject->review = $data["review"];
      $reviewObject->users_id = $data["users_id"];
      $reviewObject->img_user = $data["img_user"];
      $reviewObject->movies_id = $data["movies_id"];

      return $reviewObject;
    }

    public function create(Review $review){

      $stmt = $this->conn->prepare("INSERT INTO reviews (
        rating, review, users_id, movies_id, img_user ) 
        VALUES (
          :rating, :review, :users_id, :movies_id, :img_user
        )");

      $stmt->bindParam(":rating", $review->rating);
      $stmt->bindParam(":review", $review->review);
      $stmt->bindParam(":users_id", $review->users_id);
      $stmt->bindParam(":movies_id", $review->movies_id);
      $stmt->bindParam(":img_user", $review->img_user);

      $stmt->execute();
      $this->message->setMessage("Crítica adicionada com sucesso!", "success", "index.php");
    }

    public function getMoviesReview($id){
      $reviews = []; 
      
      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();  

      if($stmt->rowCount() > 0) {
        $reviewsData = $stmt->fetchAll();

        foreach($reviewsData as $review){
          $reviews[] = $this->buildReview($review);
        }
      }

      return $reviews;
    }

    public function hasAlreadyReviewed($id, $userId){

      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id AND users_id = :users_id");

      $stmt->bindParam(":movies_id", $id);
      $stmt->bindParam(":users_id", $userId);

      $stmt->execute();

      if($stmt->rowCount() > 0){
        return true;
      }else {
        return false;
      }
    }

    public function getRatings($id){

    }

}