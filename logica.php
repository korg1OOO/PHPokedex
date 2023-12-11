<?php

$short = "p";

$long = [
    "pokemon:"
];

$options = getopt($short, $long);

$pokemonName = isset($_GET["name"]) ? $_GET["name"] : '';

if (!empty($pokemonName)) {
    $pokemonNameLower = strtolower($pokemonName);

    $pokemonUrl = "https://pokeapi.co/api/v2/pokemon/" . $pokemonNameLower;
    $pokemonInfo = json_decode(file_get_contents($pokemonUrl), true);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stats</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 15px;
            font-weight: bold;
            margin: 5px 0;
        }
    </style>
</head>
<body>
  <h1><?= strtoupper($pokemonInfo['name']) ?></h1>
  <p>Altura: <?= $pokemonInfo['height'] ?></p>
  <p>Peso: <?= $pokemonInfo['weight'] ?></p>

  <?php
    if (isset($pokemonInfo['moves'])) {
      foreach ($pokemonInfo['moves'] as $move) {
        echo "<p>Movimento: " . $move['move']['name'] . "</p>\n";
      }
    }
  ?>
</body>
</html>
