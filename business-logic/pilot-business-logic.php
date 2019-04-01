<?php
    require_once 'bl.php';
    require_once '../model/pilot-model.php';
    class BusinessLogicPilots extends BusinessLogic{
        
        public function get(){
        
            $query = 'SELECT * FROM `pilot`';
            
            $results = $this->dal->select($query);
            $resultsArray = [];
    
            while ($row = $results->fetch()) {
                array_push($resultsArray, new pilotModel($row));
            }
    
            return $resultsArray;
        }

        public function getOne($id){
        
            $query = 'SELECT * FROM `pilot` WHERE `pilot_id` = :a';
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new pilotModel($row);
        }

        public function set($f){
        
            $query = "INSERT INTO pilot (`pilot_name`, `pilot_level`, `pilot_picture_src`)
            VALUES (:a, :b, :c)";
            $params = array(
                "a" => $f->getPilotName(),
                "b" => $f->getPilotLevel(),
                "c" => $f->getPilotPictureSrc()
            );
            $this->dal->insert($query, $params);
        }

        public function deliteId($id){
            $query = 'DELETE FROM `pilot` WHERE `pilot_id` = :a';
            $param = array(
                "a" => $id
            );
            $this->dal->delite($query, $param);
        }

    }
?>