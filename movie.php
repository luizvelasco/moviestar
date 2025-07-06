<?php

    require_once("templates/header.php");

    require_once("models/Movie.php");
    require_once("dao/MovieDAO.php");

    $id = filter_input(INPUT_GET, "id");

    $movie;

    $movieDao = new MovieDAO($conn, $BASE_URL);

    if(empty($id)) {

        $message->setMessage("O filme não foi entrado", "error", "index.php");


    } else {

        $movie = $movieDao->findById($id);

        // Verifica se o filme existe
        if(!$movie){
             $message->setMessage("O filme não foi entrado", "error", "index.php");
        }
    }

    // Chegar se o filme é do usuário
    $userOwnMovie = false;

    if(!empty($userData)) {

        if ($userData->id === $movie->users_id) {
            $userOwnMovie = true;
        }
    }

    // Resgatar as review do filme

    ?>