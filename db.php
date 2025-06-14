<?php

    // $db_name = "moviestar";
    // $db_host = "localhost";
    // $db_user = "root";
    // $db_pass = "";

    // $conn = new PDO("mysql:dbname=". $db_name . ";host=". $db_host, $db_user, $db_pass);

    // // Habilitar erros PDO
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    require_once 'env.php';
    loadEnv(__DIR__ . '/.env');

    $db_host    = $_ENV['DB_HOST'];
    $db_name    = $_ENV['DB_NAME'];
    $db_user    = $_ENV['DB_USER'];
    $db_pass    = $_ENV['DB_PASS'];
    $db_charset = $_ENV['DB_CHARSET'] ?? 'utf8';

    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $conn = new PDO($dsn, $db_user, $db_pass, $options);
    } catch (PDOException $e) {
        // error_log("Erro na conexão com o banco: " . $e->getMessage());
        // exit("Erro de conexão com o banco de dados.");
        
        // TEMPORÁRIO — Apenas para debug local
        die("Erro na conexão com o banco: " . $e->getMessage());
    }
