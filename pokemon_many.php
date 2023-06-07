<?php
$number = 10;

if(!isset($_GET["number"])){
    $number=10;
}

else if(isset($_GET["number"])){
    if($_GET["number"]==10){
        $number=10;
    }
    else if($_GET["number"]==20){
        $number=20;
    }
    else if($_GET["number"]==50){
        $number=50;
    }
}

if(!isset($_GET["before"]) && !isset($_GET["next"])){
    $page = 0;
}

else if(isset($_GET["before"])){
    $page = (int)$_GET["page"]-$number;
}
else if(isset($_GET["next"])){
    $page = (int)$_GET["page"]+$number;
}

$url = "https://pokeapi.co/api/v2/pokemon/?limit=" . $page+$number . "&offset=" . $page;
$response = file_get_contents($url);
    
$data = json_decode($response, true);
    
$url2 = "https://pokeapi.co/api/v2/pokemon-species/?limit=" . $page+$number . "&offset=" . $page;
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
    
    <form action="pokemon_detail.php" method="post">
    <?php
    for($k=0; $k<$number; $k++){
        echo '<div class="block">';
        echo '<img src = "' . $image[$k] . '">';
        echo "<br>";
        echo "名前（英語）：" . $name[$k];
        echo "<br>";
        echo "名前（日本語）：" . $japanese[$k];
        echo "<br>";
        echo "タイプ：" . $type[$k];
        echo "<br>";
        echo "たかさ：" . $height[$k];
        echo "<br>";
        echo "おもさ：" . $weight[$k];
        echo "<br>";
        echo '<input type="submit" name="submit" value=' . $page+$k+1 . '>';

        echo "<br><br>";
        echo '</div>';
    }
    ?>
    </form>
    <br><br>
    <form action="pokemon_many2.php" method="get">
        <input type="hidden" name="page" value=<?php echo $page;?>>
        <input type="submit" name="before" value="前へ">
        <input type="submit" name="next" value="次へ">
    
        <select name="number" onchange="submit(this.form)">
            <?php if($number==10){
                echo '<option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>';
            }
            else if($number==20){
                echo '<option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="50">50</option>';
            }
            else if($number==50){
                echo '<option value="10">10</option>
                <option value="20">20</option>
                <option value="50" selected>50</option>';
            }?>
        </select>
    </form>

</body>
</html>
