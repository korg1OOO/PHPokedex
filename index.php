<?php 

    $pokemons_api = file_get_contents("https://pokeapi.co/api/v2/pokemon");

    $pokemons = json_decode($pokemons_api, true);

    for ($i=0; $i < 20 ; $i++) { 
        $pokemon = $pokemons['results'][$i];
        $todas_infos_api = file_get_contents($pokemon['url']);
        $pokemons['results'][$i] = json_decode($todas_infos_api, true);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        #pesquisa {
            background: #ca3e1cfd;
            padding: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .pokemons-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .pokemon {
            padding: 15px;
            width: 20%;
            border: solid #000000;
            float: left;
            text-align: center;
            margin: 1%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .pokemon h1 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .pokemon img {
            max-width: 100%;
            height: 170px;
            border-radius: 8px;
        }

        .pokemon p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        a {
            text-decoration: none;
            color: #ca3e1cfd;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div id="pesquisa"> 
        <form action="logica.php" method="get">
                <input type="text" placeholder ="Digite o pokemon" name="name">
                <input type="submit" value="Buscar">
        </form>
    </div>
    <div id="pokemons">
        <?php
            for ($i=0; $i < 20 ; $i++): ?>
                <div class="pokemon">
                    <h1><?= ucfirst($pokemons['results'][$i]['name'])?></h1>
                    <img src="<?= $pokemons['results'][$i]['sprites']['other']['dream_world']['front_default']?>" alt="Pokemon Dewgong " width="200px">
                    <p>Altura: <?= $pokemons['results'][$i]['weight']?></p>
                    <p>Peso: <?= $pokemons['results'][$i]['height']?></p>
                    <a href="logica.php?name=<?= $pokemons['results'][$i]['name'] ?>">Ver Detalhes</a>
                </div>    
            <?php  endfor ?>
    </div>
  
</body>
</html>
