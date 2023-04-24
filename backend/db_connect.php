<?php

    require __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $DB_SERVER = $_ENV['DB_SERVER'];
    $DB_USER = $_ENV['DB_USER'];
    $DB_PASS = $_ENV['DB_PASS'];
    $DB_NAME = $_ENV['DB_NAME'];

    $conn = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME);

    if (!$conn) {
        die('Could not connect: '. mysqli_connect_error());
    }

?>