<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/MovieDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$movieDao = new MovieDAO($conn, $BASE_URL);

 //Resgata dados do usuário
 $userData = $userDao->verifyToken();

//Resgata o tipo de formulário
$type = filter_input(INPUT_POST, "type"); //Resgatar os inputs já livres de qqer dado inserido de forma maliciosa (está vindo de um POST e seu nome é type)

if ($type === "create") {

    // Receber os dados dos inputs
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $movie = new Movie;

    // Validação mínima de dados
    if (!empty($title) && !empty($description) && !empty($category)){

        $movie->title = $title;
        $movie->description = $description;
        $movie->trailer = $trailer;
        $movie->category = $category;
        $movie->length = $length;
        $movie->users_id = $userData->id;

        // Upload de imagem do filme
        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];
            //PEGANDO EXTENSÃO DO ARQUIVO
            $ext = strtolower(substr($image['name'],-4));

            //Checagem de tipo de imagem
            if (in_array($image["type"], $imageTypes)){
                
                //Checar se é jpg
                if (in_array($image["type"], $jpgArray)){
                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                //imagem é png
                } else {
                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                // Gerando o nome da imagem
                $imageName = $movie->imageGenerateName($ext);

                imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

                $movie->image = $imageName;

            } else {
                $message->setMessage("Tipo inválido de image, insira png ou jpg!", "error", "back");
                exit;
            }
        }

    $movieDao->create($movie);
    } else {
        $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
    }
} elseif ($type === "delete"){

    // Recebe os dados do form
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);

    if ($movie){

        // Verifica se o filme é do usuário
        if($movie->users_id === $userData->id){

            $movieDao->destroy($movie->id);

        } else {
            $message->setMessage("Informações inválidas.", "error", "index.php");
        }

    } else {
        $message->setMessage("Informações inválidas.", "error", "index.php");
    }

} else {
    $message->setMessage("Informações inválidas.", "error", "index.php");
}