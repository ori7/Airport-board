<?php  
    class CountryModel {
        private $country_id;
        private $country_name;

        function __construct($array) {
            if (isset($array['country_id']))
                $this->country_id = $array['country_id'];
            $this->country_name = $array['country_name']; 
        }
        
        function getCountryId() {
            return $this->country_id;
        }
        function getCountryName() {
            return $this->country_name;
        }

        function setCountryName($newCountry) {
            $this->country_name = $newCountry;
        }

    }
?>