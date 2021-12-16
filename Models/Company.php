<?php
    namespace Models;


    class Company {

        private $companyId;
        private $cuit;
        private $name;
        private $yearFundation;
        private $city;
        private $description;
        private $logo;
        private $email;
        private $phoneNumber;


        public function __construct(){
        }

        //--------------------------------------------//
        public function getCompanyId()
        {
            return $this->companyId;
        }
        public function setCompanyId($companyId)
        {
            $this->companyId= $companyId;

            return $this;
        }
        //--------------------------------------------//
        public function getCuit()
        {
            return $this->cuit;
        }
        public function setCuit($cuit)
        {
            $this->cuit= $cuit;

            return $this;
        }
        //--------------------------------------------//
        public function getName()
        {
           return $this->name;
        }
        public function setName($name)
        {
            $this->name = $name;

            return $this;
         }
        //--------------------------------------------//
        public function getYearFundation()
        {
            return $this->yearFundation;
        }
        public function setYearFundation($yearFundation)
        {
            $this->yearFundation = $yearFundation;

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
        public function getLogo()
        {
            return $this->logo;
        }
        public function setLogo($logo)
        {
            $this->logo = $logo;

            return $this;
        }
        //--------------------------------------------//
        public function getEmail()
        {
            return $this->email;
        }
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }
        //--------------------------------------------//
        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }

        public function setPhoneNumber($phoneNumber)
        {
            $this->phoneNumber = $phoneNumber;

            return $this;
        }
        //--------------------------------------------//
        public function getCity()
        {
            return $this->city;
        }
        public function setCity($city)
        {
            $this->city = $city;
            
            return $this; 
        }
        //--------------------------------------------//
    }

?>