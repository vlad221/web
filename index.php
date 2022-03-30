<?php
/* amélioration :
Si une ville se trouve dans le radius et est plus petite que la destination finale, alors on passe le 
checkpoint. Sinon on fait un trajet droit.

*/


include 'class/Ville.php';
include 'class/dico.php';
/*
Perte de temps avec JS -> plus rapide de proceder de maniere direct

paris
marseille
reims
lyon
strasbourg
vatry
toulouse
nice
nantes
bordeaux
lille
rennes
toulon
grenoble
dijon
*/

$EasyVille = array(
    array("paris", 47*900/100, 27*900/100, rand(50, 1500)),
    array("marseille", 67*900/100, 76*900/100, rand(50, 1500)),
    array("reims", 62*900/100, 27*900/100, rand(50, 1500)),
    array("lyon", 65*900/100, 57*900/100, rand(50, 1500)),
    array("strasbourg", 82*900/100, 32*900/100, rand(50, 1500)),
    array("vatry", 57*900/100, 29*900/100, rand(50, 1500)),
    array("toulouse", 43*900/100, 74*900/100, rand(50, 1500)),
    array("nice", 79*900/100, 75*900/100, rand(50, 1500)),
    array("nantes", 28*900/100, 43*900/100, rand(50, 1500)),
    array("bordeaux", 32*900/100, 63*900/100, rand(50, 1500)),
    array("lille", 54*900/100, 11*900/100, rand(50, 1500)),
    array("rennes", 25*900/100, 25*900/100, rand(50, 1500)),
    array("toulon", 73*900/100, 73*900/100, rand(50, 1500)),
    array("grenoble", 71*900/100, 71*900/100, rand(50, 1500)),
    array("dijon", 67*900/100, 44*900/100, rand(50, 1500))
);
$encoded = json_encode($EasyVille);

//Max number of cities (available name of 15)
$num_of_Cities = 10; // Max 10 or less

$nameofCities = new dico($num_of_Cities);
$nameCities = $nameofCities->randomNames();

//remove \r \n
$a =  preg_replace("!\r?\n!", "", $nameCities);
$encoded2 = json_encode($a);

?>
<html>
    <head>
        <title>Test projet GOAP</title>
        <script src="index.js"></script>
        <link rel="stylesheet" type="text/css" href=<?php echo '"style.css?v='.time().'"' ?> media="all"/>
    </head>
    <body>
        <div id="map">

            <?php
                for($i=0; $i<$num_of_Cities; $i++){
                    echo '<button id="'.$nameCities[$i].'"class="button boxes'.$nameCities[$i].'" 
                    onClick="reply_click(this.id)" onmouseenter="getDestination(this.id)" 
                    onmouseleave="refreshDraw(this.id)">';
                        new Ville($EasyVille, $nameCities[$i]);
                    echo '</button>';
                }
            ?>
            <canvas id="Canvas" width="900" height="900"></canvas>
        </div>
        <div id="information">
            <div id="preview">
            </div>
        </div>

        <script type="text/javascript">
            // On envoie tout le tableau des villes avec infos  
           loadArray(<?php echo $encoded;?>, <?php echo $encoded2 ?>)
        </script>
        
    </body>
</html>