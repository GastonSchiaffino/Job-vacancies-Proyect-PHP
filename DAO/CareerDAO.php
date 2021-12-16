<?php
    namespace DAO;

    use Utils\Utils as Utils;
    use Models\Career as Career;

    class CareerDAO implements ICareerDAO
    {
        private $careerList = array();

        public function GetAll()
        {   
            $this->RetrieveData();

            return $this->careerList;
        }

        private function RetrieveData(){

            $arrayToDecode= Utils::apiConsume("Career");

            foreach($arrayToDecode as $valuesArray)
            {
                $career = new Career();
                $career->setCareerId($valuesArray["careerId"]);
                $career->setDescription($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);
                    
                array_push($this->careerList, $career);
            }  

            return $this->careerList;
        }
        
    }

    
?>