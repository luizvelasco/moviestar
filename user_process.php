<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

//Resgata o tipo de formulário
$type = filter_input(INPUT_POST, "type"); //Resgatar os inputs já livres de qqer dado inserido de forma maliciosa (está vindo de um POST e seu nome é type)

//Atualizar usuário
if ($type === "update") {

    //Resgata dados do usuário
    $userData = $userDao->verifyToken();

    //Recebe dados do POST
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    //Criar um novo obj de usuário
    $user = new User();

    //Preenche os dados do usuário
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    //Upload da imagem
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
        
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];
        //PEGANDO EXTENSÃO DO ARQUIVO
        $ext = strtolower(substr($image['name'],-4));

        //Checagem de tipo de imagem
        if (in_array($image["type"], $imageTypes)){
            
            //Checar se é jpg
            if (in_array($image["type"], $jpgArray)){

                $imageName = $user->imageGenerateName($ext);

                $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                imagejpeg($imageFile, "./img/users/" . $imageName, 100);


            //imagem é png
            } else {

                $imageName = $user->imageGenerateName($ext);

                $imageFile = imagecreatefrompng($image["tmp_name"]);

                imagejpeg($imageFile, "./img/users/" . $imageName, 100);


            }

            $userData->image = $imageName;


        } else {
            $message->setMessage("Tipo inválido de image, insira png ou jpg!", "error", "back");
            exit;
        }

    }

    $userDao->update($userData);

    
//Atualizar senha do usuário
} else if ($type === "changepassword"){

     //Recebe dados do POST
     $password = filter_input(INPUT_POST, "password");
     $confirmpassword = filter_input(INPUT_POST, "confirmpassword");
     
     //Resgata dados do usuário
     $userData = $userDao->verifyToken();
     $id = $userData->id;

     if ($password == $confirmpassword) {

        // Criar um novo objeto de usuário
        $user = new User();

        $finalPassword = $user->generatePassword($password);

        $user->password = $finalPassword;
        $user->id = $id;

        $userDao->changePassword($user);

        
     } else {
        $message->setMessage("As senhas não são iguais.", "error", "back");
     }

}  else {
    $message->setMessage("Informações inválidas.", "error", "index.php");
}