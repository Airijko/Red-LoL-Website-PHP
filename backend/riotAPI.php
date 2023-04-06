<?php

    require __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    function getPlayerData($searchProfile) {
        $API_KEY = $_ENV['API_KEY'];

        $url = "https://na1.api.riotgames.com/lol/summoner/v4/summoners/by-name/" . rawurlencode($searchProfile) . "?api_key=" . $API_KEY;

        $response = @file_get_contents($url);
    
        if (!$response) {
            return false;
        }

        return json_decode($response, true) ?: false;
    }

?>
