<?php

class pathfinding {

    public $ArrayListCities;
    private $spawnedCities;
    private $CheckpointArray;
    
    function search($arrayCities, $spawnedCits, $name){

        $this->spawnedCities = $spawnedCits;
        if(isset($arrayCities)){

            $currentCity = array_search($name, array_column($arrayCities, 0));
            return $this->createPath($currentCity, $arrayCities);    
        }
    }

    function createPath($currentCity, $arrayCities){

            for($i=0; $i<sizeof($arrayCities); $i++){

                if($this->insideRadius($arrayCities[$i][1], $arrayCities[$i][2], 
                $arrayCities[$currentCity][1], $arrayCities[$currentCity][2], 250) == true && 
                $arrayCities[$i][0] != $arrayCities[$currentCity][0]){
                    for($x=0; $x<sizeof($this->spawnedCities); $x++){
                        if($arrayCities[$i][0] == $this->spawnedCities[$x]){
                            
                            $this->CheckpointArray[] = $arrayCities[$i][3];

                        }
                    }
                }
            }

            if(isset($this->CheckpointArray)){
                for($y=0; $y<sizeof($arrayCities); $y++){
                    if($arrayCities[$y][3] == min($this->CheckpointArray)){

                        $minArr = $y;
                        break;
                    }
                }
                return $this->checkpoint($minArr);
            }
            else{
            // var_dump($minArr);
                return $this->checkpoint($currentCity);
            }

    }

    function insideRadius($x, $y, $center_x, $center_y, $radius){
        if (($x - $center_x)*($x - $center_x)+($y - $center_y)*($y - $center_y)<=$radius*$radius){
            return true;
        }
        else{
            return false;
        }
    }

    function angle(){
        
    }

    function checkpoint($minArr){

        // echo $minArr;
        return $minArr;

    }

}

?>