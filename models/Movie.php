<?php

  class Movie {

    public $id;
    public $title;
    public $description;
    public $img;
    public $trailer;
    
    public $category;
    
    public $length;
    
    public $users_id;
    public $rating;

    // Duplicando código pq só vou repetir esta função, mas o correto seria criar um model para img;
    public function imageGenerateName(){
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  interface MovieInterface {

    public function buildMovie($data);
    public function findAll();
    public function getLatesMovies();
    public function getMovieByCategory($category);
    public function getMovieByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(Movie $movie);
    public function update(Movie $movie);
    public function destroy($id);

  }