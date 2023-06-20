<?php

require_once("templates/header.php");

//Verifica se usuário está de fato logado
if ($userDao) {
    $userDao->destroyToken();
}