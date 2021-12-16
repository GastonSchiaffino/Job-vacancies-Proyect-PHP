<?php
    namespace Controllers;

    use DAO\CareerDAO as CareerDAO;
    use Models\Student as Student;
    use Models\Career as Career;

    class CareerController
    {
        private $careerDAO;

        public function __construct()
        {
            $this->careerDAO = new CareerDAO();
        }
        public function GetAll(){
            $arrayCareer=$this->careerDAO->GetAll();
            return $arrayCareer;
        }

        public function CareerById($id,$arrayCareer){
            foreach($arrayCareer as $valuesCareer){
                if($id== $valuesCareer->getCareerId()){
                    return $valuesCareer; 
                }
            }
        }

        

    }
?>