<?php

    namespace Controllers;

    use Utils\Utils as Utils;
    use DAO\JobPositionDAO as JobPositionDAO;
    use Models\JobPosition as JobPosition;

    class JobPositionController{

    
        private $JobPositionDAO;

        public function __construct()
        {
            $this->JobPositionDAO = new JobPositionDAO();
        }

        public function GetAll(){
            $answer=$this->JobPositionDAO->GetAll();
            return $answer;
        }

        public function JobPositionById($id,$arrayJobPosition)
        {
           
            foreach($arrayJobPosition as $values){
                if($id== $values->getJobPositionId()){
                    return $values; 
                }
            }
        }
    }
?>