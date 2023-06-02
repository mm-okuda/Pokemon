<?php

$url = "https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0";
$responce = file_get_contents($url);

$data = json_decode($response, true);

print("<pre>");
foreach($data["results"] as $key => $value){
    car_dump($value["name"]);
}
print("</pre>");