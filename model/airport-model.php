<?php  
    class AirportModel {
        private $airport_id;
        private $airport_name;
        private $airport_country_id;

        function __construct($array) {
            if (isset($array['airport_id']))
               $this->airport_id = $array['airport_id'];
            $this->airport_name = $array['airport_name']; 
            $this->airport_country_id = $array['airport_country_id'];
        }

        function getAirportId() {
            return $this->airport_id;
        }
        function getAirportName() {
            return $this->airport_name;
        }
        function getAirportCountryId() {
            return $this->airport_country_id;
        }

        function setAirportName($airport_name) {
            $this->airport_name = $airport_name;
        }
    }
?>