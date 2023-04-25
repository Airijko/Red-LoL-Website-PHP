<?php

  session_start();

  require('backend/db_connect.php');
  require('backend/riotAPI.php');
  require('vendor/autoload.php');

  include 'pages/login.php';

  $searchProfile = !empty($_POST["searchProfile"]) ? $_POST["searchProfile"] : null;
  $playerData = array();
  $searchSuccess = true;

  if (isset($_POST["searchProfile"])) {
    $searchProfile = $_POST["searchProfile"];
    $data = getPlayerData($searchProfile);
    if ($data) {
      $playerData = $data;
      $searchSuccess = true;
    } else {
      $searchSuccess = false;
      $playerData = array();
    }
  }

  function renderData($playerData) {
    $URL = 'http://ddragon.leagueoflegends.com/cdn/13.6.1/img/profileicon/';
  
    return '<h3>' . $playerData["name"] . '</h3>
            <img width="150" src="' . $URL . $playerData["profileIconId"] . '.png" alt="icon" />
            <p>Summoner Level - ' . $playerData["summonerLevel"] . '</p>';
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/index.css" type="text/css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/AJAX.js"></script>
    <title>Document</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div id="container" class="container container-fluid home">
        <h1 class="playerSearchTitle">LOL PROFILE CARD SEARCH</h1>
        <form method="post" class="playerSearchForm">
            <input type="hidden" name="formType" value="playerSearchForm">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" name="searchProfile"
                    value="<?php echo htmlspecialchars($searchProfile); ?>" />
                <button type="submit" id="logobutton">
                    <img src="images/logo.png" alt="logo" id="logo" />
                </button>
            </div>
        </form>
        <?php if (!$searchSuccess) {
          echo '<div class="data"><p>Error: Invalid Profile.</p></div>';
        } else if ($playerData != array()) {
          echo '<div class="data">' . renderData($playerData) . '</div>';
        } ?>
    </div>
</body>

</html>