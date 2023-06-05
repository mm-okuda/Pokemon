<?php

$url = "https://pokeapi.co/api/v2/pokemon/1/";
$response = file_get_contents($url);

$data = json_decode($response, true);

$url2 = "https://pokeapi.co/api/v2/pokemon-species/1/";
$response2 = file_get_contents($url2);

$data2 = json_decode($response2, true);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポケモン図鑑</title>
</head>
<body>
    <h1>ポケモン図鑑</h1>
    <p>
       <img src = <?php echo $data["sprites"]["front_default"]; ?> ><br>
       名前（英語）：<?php echo $data["name"]; ?><br>
       名前（日本語）：<?php echo $data2["names"][0]["name"]; ?><br>
       高さ：<?php echo $data["height"]; ?><br>
       重さ：<?php echo $data["weight"]; ?>
    </p>
    
    
    
</body>
</html>
