<?php

include 'class/pathfinding.php';

$Cpathfinding = new pathfinding();

    $q = $_GET["q"];
    $name = $_GET["n"];
    $pathfinding = $_GET["pathfinding"];

    $citySpawned = json_decode($pathfinding);
    $FullCities = json_decode($q); // recupere tableau  

    $encodedReturn = json_encode($Cpathfinding->search($FullCities, $citySpawned, $name));

    echo $FullCities[$encodedReturn][0];
?>