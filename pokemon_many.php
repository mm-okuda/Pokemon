<?php

if(!isset($_GET["before"]) && !isset($_GET["next"])){
    $page = 0;
}

else if(isset($_GET["before"])){
    $page = (int)$_GET["page"]-10;
}
else if(isset($_GET["next"])){
    $page = (int)$_GET["page"]+10;
}

$url = "https://pokeapi.co/api/v2/pokemon/?limit=" . $page+10 . "&offset=" . $page;
$response = file_get_contents($url);

$data = json_decode($response, true);

$url2 = "https://pokeapi.co/api/v2/pokemon-species/?limit=" . $page+10 . "&offset=" . $page;
$response2 = file_get_contents($url2);

$data2 = json_decode($response2, true);

$i = 0;
$n = 0;

foreach($data["results"] as $value){
    //var_dump($data["results"]);

    $response = file_get_contents($value["url"]);
    $data = json_decode($response, true);

    $name[$i] = $value["name"];
    $image[$i] = $data["sprites"]["front_default"]; 
    $type[$i] = $data["types"][0]["type"]["name"];
    $height[$i] = $data["height"];
    $weight[$i] = $data["weight"];

    $i++;
}   

foreach($data2["results"] as $value2){
    $response = file_get_contents($value2["url"]);
    $data2 = json_decode($response, true);

    $japanese[$n] = $data2["names"][0]["name"];

    $n++;
}       



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pokemon.css">
    <title>ポケモン図鑑</title>
</head>
<body>
    <h1>ポケモン図鑑</h1>
    
    <?php
    for($k=0; $k<10; $k++){
        echo '<div class="block">';
        echo '<img src = "' . $image[$k] . '">';
        echo "<br>";
        echo "名前（英語）：" . $name[$k];
        echo "<br>";
        echo "名前（日本語）：" . $japanese[$k];
        echo "<br>";
        echo "タイプ：" . $type[$k];
        echo "<br>";
        echo "高さ：" . $height[$k];
        echo "<br>";
        echo "重さ：" . $weight[$k];
        echo "<br><br>";
        echo '</div>';
    }
    ?>
    <br><br>
    <form action="pokemon_many2.php" method="get">
        <input type="hidden" name="page" value=<?php echo $page;?>>
        <input type="submit" name="before" value="前へ">
        <input type="submit" name="next" value="次へ">
    </form>
</body>
</html>
