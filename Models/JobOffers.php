<?php

    namespace Models;

    class JobOffers{
        private $jobOffersId;
        private $jobPositionId;
        private $description;
        private $studentId=array();
        private $companyId;
        private $active;
        private $image;
        
        public function __construct (){
        }

        //--------------------------------------------//
        public function getJobOffersId()
        {
                return $this->jobOffersId;
        }
        public function setJobOffersId($jobOffersId)
        {
                $this->jobOffersId = $jobOffersId;

                return $this;
        }
        //--------------------------------------------//
        public function getJobPositionId()
        {
                return $this->jobPositionId;
        }
        public function setJobPositionId($jobPositionId)
        {
                $this->jobPositionId = $jobPositionId;

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
        public function getStudentId()
        {
                return $this->studentId;
        }
        public function setStudentId($StudentId)
        {
                $this->studentId = $StudentId;

                return $this;
        }
         //--------------------------------------------//
         public function getCompanyId()
         {
                 return $this->companyId;
         }
         public function setCompanyId($CompanyId)
        {
                $this->companyId = $CompanyId;

                return $this;
        }
        //--------------------------------------------//
        public function getActive()
        {
                return $this->active;
        }

      
        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }
        //--------------------------------------------------//
        public function getImage()
        {
                return $this->image;
        }

       
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }
        //-------------------------------------------------//
        public function studentIdPush($id){
                array_push($this->studentId,$id);
        }

    }
