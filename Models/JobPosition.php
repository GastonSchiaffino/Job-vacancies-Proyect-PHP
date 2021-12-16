<?php

    namespace Models;

    class JobPosition{

        private $jobPositionID;
        private $careerId;
        private $description;

        
        public function __construct (){
        }

        //--------------------------------------------//
        public function getJobPositionID()
        {
                return $this->jobPositionID;
        }
        public function setJobPositionID($jobPositionID)
        {
                $this->jobPositionID = $jobPositionID;

                return $this;
        }
       //--------------------------------------------//
        public function getCareerId()
        {
                return $this->careerId;
        }
        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;

                return $this;
        }
       //--------------------------------------------//
        public function getDescription()
        {
                return $this->description;
        }
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
        //--------------------------------------------//

    }

?>