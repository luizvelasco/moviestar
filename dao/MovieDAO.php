<?php

    require_once("models/Movie.php");
    require_once("models/Message.php");

    // Reviu DAO

    class MovieDAO implements MovieDAOInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data) {

            $movie = new Movie();

            $movie->id = $data["id"];
            $movie->title = $data["title"];
            $movie->description = $data["description"];
            $movie->image = $data["email"];
            $movie->trailer = $data["trailer"];
            $movie->category = $data["category"];
            $movie->length = $data["length"];
            $movie->users_id = $data["users_id"];
            
        }

        public function findAll() {
            
        }
        public function getLatestMovies() {
            
        }
        public function getMoviesByCategory($category) {
            
        }
        public function getMovieByUserId($id) {
            
        }
        public function findById($id) {
            
        }
        public function findByTitle($title) {
            
        }
        public function create(Movie $movie) {
            
        }
        public function update(Movie $movie) {
            
        }
        public function destroy ($id) {
            
        }

    }