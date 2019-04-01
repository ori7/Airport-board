<?php
    require_once 'bl.php';
    require_once '../model/flight-model.php';
    class BusinessLogicFlights extends BusinessLogic{
        public function get(){
        
            $query = 'SELECT * FROM `flight`';
            
            $results = $this->dal->select($query);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new FlightModel($row));
            }
    
            return $resultsArray;
        }

        public function getByDate($from_date, $to_date){
        
            $query = 'SELECT * FROM `flight` WHERE `flight_datetime` BETWEEN :a AND :b';
            $params = array(
                "a" => $from_date,
                "b" => $to_date
            );
            $results = $this->dal->select($query,$params);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new FlightModel($row));
            }
    
            return $resultsArray;
        }
/*
        public function getByPilot($id){
        
            $query = 'SELECT * FROM `flight` WHERE `flight_pilot_id` = :a';
            $params = array(
                "a" => $id
            );
            $results = $this->dal->select($query,$params);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new FlightModel($row));
            }
    
            return $resultsArray;
        }

        public function getByFlightTo($id){
        
            $query = 'SELECT * FROM `flight` WHERE `flight_to` = :a';
            $params = array(
                "a" => $id
            );
            $results = $this->dal->select($query,$params);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new FlightModel($row));
            }
    
            return $resultsArray;
        }
*/
        public function set($f) {
            $query = "INSERT INTO flight (`flight_no`, `flight_datetime`, `flight_from`, `flight_to`, `flight_pilot_id`)
            VALUES (:a, :b, :c, :d, :e)";
            $params = array(
                "a" => $f->getFlightNo(),
                "b" => $f->getFlightDatetime(),
                "c" => $f->getFlightFrom(),
                "d" => $f->getFlightTo(),
                "e" => $f->getFlightPilotId(),
            );
            $this->dal->insert($query, $params);
        }

        public function deliteId($id){
            $query = "DELETE FROM `flight` WHERE `flight_id` = :a";
            $param = array(
                "a" => $id
            );
            $this->dal->delite($query, $param);
        }

        public function updateId($flight, $id) {
            $query = "UPDATE `flight` SET `flight_no`= :a ,`flight_datetime`= :b ,`flight_from`= :c ,`flight_to`= :d ,`flight_pilot_id`= :e
            WHERE `flight_id` = :f";
            $params = array(
                "a" => $flight->getFlightNo(),
                "b" => $flight->getFlightDatetime(),
                "c" => $flight->getFlightFrom(),
                "d" => $flight->getFlightTo(),
                "e" => $flight->getFlightPilotId(),
                "f" => $id
            );
            $this->dal->update($query, $params);
        }
    }
?>
