<?php
    $data = file_get_contents('https://ddragon.leagueoflegends.com/cdn/13.6.1/data/en_US/champion.json?');
    $json = json_decode($data, true);

    $iconURL = "https://ddragon.leagueoflegends.com/cdn/13.6.1/img/champion/";
    $championWiki = "https://www.leagueoflegends.com/en-us/champions/";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/global.css" type="text/css" rel="stylesheet">
    <link href="css/champions.css" type="text/css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <div class="container-fluid champions">
      <h1>Champion List</h1>
      <div class="container-grid">
        <?php foreach ($json['data'] as $champion) : ?>
            <div class="champ-card" key=<?php $champion['id']?>>
                <h2><?= $champion['name'] ?></h2>
                <a href="<?= $championWiki . $champion['name']?>">
                    <img src="<?= $iconURL . $champion['image']['full'] ?>">
                </a>
                <p><?= $champion['title'] ?></p>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
</body>
</html>