<?php

$url = "https://pokeapi.co/api/v2/pokemon/1/";
$response = file_get_contents($url);

$data = json_decode($response, true);

print("<pre>");
var_dump($data["name"]);
var_dump($data["sprites"]["front_default"]);
var_dump($data["height"]);
var_dump($data["weight"]);
print("</pre>");