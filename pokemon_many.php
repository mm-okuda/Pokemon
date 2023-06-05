<?php

$url = "https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0";
$response = file_get_contents($url);

$data = json_decode($response, true);

$i = 0;

foreach($data["results"] as $value){
    //var_dump($data["results"]);

    $response = file_get_contents($value["url"]);
    $data = json_decode($response, true);

    $name[$i] = $value["name"];
    $image[$i] = $data["sprites"]["front_default"]; 
    $height[$i] = $data["height"];
    $weight[$i] = $data["weight"];

    $i++;
}       

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
    <?php
    for($k=0; $k<10; $k++){
        echo $name[$k];
        echo "<br>";
        echo '<img src = "' . $image[$k] . '">';
        echo "<br>";
        echo $height[$k];
        echo "<br>";
        echo $weight[$k];
        echo "<br><br>";
    }
    ?>    
</body>
</html>
