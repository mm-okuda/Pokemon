<?php

if($_POST["submit"]){
    $url = "https://pokeapi.co/api/v2/pokemon/" . $_POST["submit"] . "/";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $response1 = file_get_contents($data["types"][0]["type"]["url"]);
    $data1 = json_decode($response1, true);

    if(isset($data["types"][1])){
        $response3 = file_get_contents($data["types"][1]["type"]["url"]);
        $data3 = json_decode($response3, true);
    }

    $url2 = "https://pokeapi.co/api/v2/pokemon-species/". $_POST["submit"] . "/";
    $response2 = file_get_contents($url2);

    $data2 = json_decode($response2, true);
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
    <div class="image">
       <img src = <?php echo $data["sprites"]["front_default"]; ?> class="front">
       <img src = <?php echo $data["sprites"]["back_default"]; ?> class="back"><br>
       名前：<?php echo $data["name"] . "（" . $data2["names"][0]["name"] . "）"; ?><br><br>
       タイプ：<?php echo $data["types"][0]["type"]["name"] . "（" . $data1["names"][0]["name"] . "）" ?>
       <?php if(isset($data["types"][1])){
          echo "、" . $data["types"][1]["type"]["name"] . "（" . $data3["names"][0]["name"] . "）";
       }?><br><br>
       説明：<?php echo $data2["flavor_text_entries"][29]["flavor_text"]; ?><br>
       <?php echo $data2["flavor_text_entries"][45]["flavor_text"]; ?><br>
       <?php echo $data2["flavor_text_entries"][62]["flavor_text"]; ?><br><br>
       たかさ：<?php echo $data["height"]; ?><br><br>
       おもさ：<?php echo $data["weight"]; ?><br><br><br>
</div>
<a href="#" onclick="history.back()">前のページに戻る</a>
    
</body>
</html>
