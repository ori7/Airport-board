<?php  
    class FlightModel {
        private $flight_id;
        private $flight_no;
        private $flight_datetime;
        private $flight_from;
        private $flight_to;
        private $flight_pilot_id;
        private $pilotModel;
        private $airportModel;
        
        function __construct($array) {
            if (isset($array['flight_id']))
                $this->flight_id = $array['flight_id'];
            $this->flight_no = $array['flight_no']; 
            $this->flight_datetime = $array['flight_datetime'];
            $this->flight_from = $array['flight_from'];
            $this->flight_to = $array['flight_to'];
            $this->flight_pilot_id = $array['flight_pilot_id'];
        }

        function getFlightId() {
            return $this->flight_id;
        }
        function getFlightNo() {
            return $this->flight_no;
        }
        function getFlightDatetime() {
            return $this->flight_datetime;
        }
        function getFlightFrom() {
            return $this->flight_from;
        } 
        function getFlightTo() {
            return $this->flight_to;
        } 
        function getFlightPilotId() {
            return $this->flight_pilot_id;
        }
        function getPilotModel() {
            if (empty($this->pilotModel)) {
                $blp = new BusinessLogicPilots();
                $this->pilotModel = $blp->getOne($this->flight_pilot_id);
            }
            return $this->pilotModel;
        }
        function getAirportModel($id) {
            $bla = new BusinessLogicAirport();
            $this->airportModel = $bla->getOne($id);
            return $this->airportModel;
        }
    }
?>