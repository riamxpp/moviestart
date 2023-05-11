<?php 

  class Review {

    public $id;
    public $rating;
    public $review;
    public $users_id;
    public $img_user;
    public $movies_id;

  }

  interface ReviewInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getMoviesReview($id);
    public function hasAlreadyReviewed($id, $userId);
    public function getRatings($id);

  }