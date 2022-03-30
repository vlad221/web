<?php

class dico {

    private $_url;
    private $_dico;
    private $_nbrCities;
    
    function __construct($numberofCities){

        $this->_url = './Docs/dic.txt';
        $this->_dico = file($this->_url);
        $this->_nbrCities = $numberofCities;

        //$this->randomNames();
    }

    function randomNames(){

        $input = $this->_dico;
        $rand_keys = array_rand($input, $this->_nbrCities);

        
        for($i=0; $i<$this->_nbrCities; $i++){
            $arr_names[] = $input[$rand_keys[$i]];
        }

        return $arr_names;
        
    }

}

?>