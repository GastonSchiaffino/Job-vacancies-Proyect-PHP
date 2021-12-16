<?php
    namespace DAO;

    use Utils\Utils as Utils;
    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;
    
    class JobPositionDAO implements IJobPositionDAO{

        private $JobPositionList = array();
    
        public function GetAll()
        {
            $this->RetrieveData();

            return $this->JobPositionList;
        }

        private function RetrieveData()
        {
            $this->JobPositionList = array();

            $arrayToDecode = Utils::apiConsume("JobPosition");

            foreach($arrayToDecode as $valuesArray)
            {
                    $jobposition = new jobposition();
                    $jobposition->setJobPositionID($valuesArray["jobPositionId"]);
                    $jobposition->setCareerId($valuesArray["careerId"]);
                    $jobposition->setDescription($valuesArray["description"]);
                 
                            
                    array_push($this->JobPositionList, $jobposition);
            }
        }

    }

?>