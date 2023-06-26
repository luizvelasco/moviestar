<?php
    require_once("templates/header.php");
    
    require_once("dao/MovieDAO.php");
    require_once("dao/UserDAO.php");
    require_once("models/Movie.php");

    //Pegar o id do Filme
    $id = filter_input(INPUT_GET, "id");
    
    $movie;

    $movieDao = new MovieDAO($conn, $BASE_URL);

    if (empty($id)){

        $message->setMessage("O Filme não foi encontrado", "error", "index.php");

    } else {

        $movie = $movieDao->findById($id);

        // Verifica se o filme existe
        if (!$movie){

            $message->setMessage("O Filme não foi encontrado", "error", "index.php");

        }

    }

    // Checar se filme é do usuário
    $userOwnsMovie = false;

    if (!empty($userData)){

        if ($userData->id === $movie->users_id) {
            $userOwnsMovie = true;
        }

    }

    // Resgatar as reviews do filme

    ?>

    <div id="main-container" class="container-fluid">
        <div class="row">
            <div class="offset-md-1 col-md-6 movie-container">
                <h1 class="page-title"><?= $movie->title?></h1>
                <p class="movie-details">
                    <span>Duração: <?= $movie->length?></span>
                    <span class="pipe"></span>
                    <span><?= $movie->category?></span>
                    <span class="pipe"></span>
                    <span><i class="fas fa-star"></i> 9</span>
                </p>
                
            </div>
        </div>
    </div>


<?php
    require_once("templates/footer.php");
?>