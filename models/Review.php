<?php

class Review {

    public $id;
    public $rating;
    public $review;
    public $users_id;
    public $movies_id;

}

interface ReviewDAOInterface {

    public function buildReview($data); //Fazer o objeto do Review. Recebe um array com dados
    public function create(Review $review); //crear o review. Recebe o objeto de fato
    public function getMoviesReview($id); //Receber todas as notas e reviews pelo seu id 
    public function hasAlreadyReviewd($id, $userId); // Saber se o usuário já fez a revisão daquele filme. Recebe o filme e o usuário
    public function getRatings($id); // Recebe todas as notas de um filme. Recebe o id do filme

}