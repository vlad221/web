<?php

class Ville {

    private $_pos;
    private $_nameofCities;
    private $_EasyVille;
    private $_distance;
    private $_array;
    private $_arr;

    function __construct($array, $name){
        $this->_nameofCities = $name;
        $this->_array = $array;
        
        for($i=0; $i<sizeof($this->_array); $i++){

            // trim à cause d'un espace ou encodage (strcmp)
            if(trim($this->_nameofCities) == trim($this->_array[$i][0])){
                
                $this->_distance = $this->_array[$i][3];
            break;
            }
        }
        
        $this->generate_city($this->_distance, $this->_nameofCities);
    }
    

    function generate_city($nbr, $cityName){

        echo $nbr.' '.$cityName;
    }
}

?>