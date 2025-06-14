<?php

    require_once("globals.php");
    require_once("db.php");
    require_once ("models/User.php");
    require_once ("models/Message.php");
    require_once ("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    // Resgata o tipo do formulário
    $type = filter_input(INPUT_POST, "type");

    // Verificação do tipo de formulário
    if ($type === "register") {

        $name = filter_input(INPUT_POST, "name");
        $lastame = filter_input(INPUT_POST, "lastame");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        // VErificação de dados mínimos
        if ($name && $lastame && $email && $password) {



        } else {

            // Enviar msg de erro, de dados faltantes
            $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

        }

    } else if ($type === "login") {

    }
