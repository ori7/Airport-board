<?php
    require_once 'bl.php';
    require_once '../model/airport-model.php';
    class BusinessLogicAirport extends BusinessLogic{
        public function get()
        {
            $q = 'SELECT * FROM `airport`';
            
            $results = $this->dal->select($q);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new airportModel($row));
            }
    
            return $resultsArray;
        }

        public function getOne($id)
        {
            $query = 'SELECT * FROM `airport` WHERE `airport_id` = :a';
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new airportModel($row);
        }

        public function getOneByName($param){
            $query = "SELECT * FROM `airport` WHERE `airport_name` = :a";
            $param = array(
                "a" => $param->getAirportName(),
            );
            $result = $this->dal->select($query,$param);
            $row = $result->fetch();
            return $row;
        }

        public function set($f) {
            $query = "INSERT INTO airport (`airport_name`, `airport_country_id`)
            VALUES (:a, :b)";
            $params = array(
                "a" => $f->getAirportName(),
                "b" => $f->getAirportCountryId()
            );
            $this->dal->insert($query, $params);
        }
    }
?>