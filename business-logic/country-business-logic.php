<?php
    require_once 'bl.php';
    require_once '../model/country-model.php';

    class BusinessLogicCountry extends BusinessLogic{
        
        public function get()
        {
            $q = 'SELECT * FROM `country`';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new countryModel($row));
            }
            return $resultsArray;
        }

        public function getOne($param){
            $query = "SELECT * FROM `country` WHERE `country_name` = :a";
            $param = array(
                "a" => $param->getCountryName(),
            );
            $result = $this->dal->select($query,$param);
            $row = $result->fetch();
            return $row;
        }

        public function set($f) {
            $query = "INSERT INTO `country` (`country_name`)
            VALUES (:a)";
            $params = array(
                "a" => $f->getCountryName()
            );
            $this->dal->insert($query, $params);
        }
    }
?>
