<?php

    require __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $DB_DSN = $_ENV['DB_DSN'];
    $DB_USER = $_ENV['DB_USER'];
    $DB_PASS = $_ENV['DB_PASS'];

    define('DB_DSN',$DB_DSN);
    define('DB_USER',$DB_USER);
    define('DB_PASS',$DB_PASS);     
     
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die();
    }

?>