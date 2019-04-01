<?php  
    class PilotModel {
        private $pilot_id;
        private $pilot_name;
        private $pilot_level;
        private $pilot_picture_src;

        function __construct($array) {
            if (isset($array['pilot_id']))
                $this->pilot_id = $array['pilot_id'];
            $this->pilot_name = $array['pilot_name']; 
            $this->pilot_level = $array['pilot_level'];
            $this->pilot_picture_src = $array['pilot_picture_src'];
        }
        
        function getPilotId() {
            return $this->pilot_id;
        }
        function getPilotName() {
            return $this->pilot_name;
        }
        function getPilotLevel() {
            return $this->pilot_level;
        }
        function getPilotPictureSrc() {
            return $this->pilot_picture_src;
        }
    }
?>