<?php
    namespace DAO;

    use Utils\Utils as Utils;
    use DAO\IJobOffersDAO as IJobOffersDAO;
    use Models\JobOffers as JobOffers;
    use DAO\Connection as Connection;
    use Exception;
    
    class JobOffersDAO implements IJobOffersDAO{

        private $JobOffersList = array();
        private $connection;
        private $tableName = "jobOffers";

        public function Add(JobOffers $joboffers)
        {
            return $this->SaveData($joboffers);
        }

        private function SaveData(JobOffers $joboffers){
           
            try
            {
                $query = "INSERT INTO ".$this->tableName." (jobPositionId, descriptionOffers, companyId, active,image) VALUES (:jobPositionId, :description, :companyId, :active,:image);";
                
                $parameters["jobPositionId"] = $joboffers->getJobPositionId();
                $parameters["description"] = $joboffers->getDescription();
                $parameters["companyId"] = $joboffers->getCompanyId();
                $parameters["active"]=$joboffers->getActive();
                $parameters["image"]=$joboffers->getImage();

                $this->connection = Connection::GetInstance();

                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters, 0);

                return "OFERTA LABORAL REGISTRADA CORRECTAMENTE.";
            }
            catch(Exception $ex)
            {
                return $ex->getMessage();
            }
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->jobOffersList;
        }


        private function RetrieveData(){

            try
            {
                $this->jobOffersList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $jobOffers = new  JobOffers();

                    $jobOffers->setJobOffersId($row["jobOffersId"]);
                    $jobOffers->setJobPositionId($row["jobPositionId"]);
                    $jobOffers->setDescription($row["descriptionOffers"]);
                    $jobOffers->setCompanyId($row["companyId"]);
                    $jobOffers->setActive($row["active"]);
                    $jobOffers->setImage($row["image"]);

                    $query2 = "SELECT studentId FROM JobOffersForStudents WHERE jobOffersId =".$row["jobOffersId"];
                    $this->connection = Connection::GetInstance();
                    $resultSet2 = $this->connection->Execute($query2);
                    foreach($resultSet2 as $row2){
                        $jobOffers->studentIdPush($row2["studentId"]);
                    }

                   //die(var_dump($resultSet2));



                    array_push($this->jobOffersList, $jobOffers);
                }

                return $this->jobOffersList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Podriamos implementar esta busqueda buscando por jobPositionId para traer todas las ofertas de una posicion (java, php, etc)
        public function Search($id)
        {
            try
            {
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".joboffersid = '".$id."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    if($id==$row->getJobOffersId()){             
                        $jobOffers = new  JobOffers();
                        $jobOffers->setJobPositionId($row["jobPositionId"]);
                        $jobOffers->setDescription($row["description"]);
                        $jobOffers->setStudentId($row["studentId"]);
                        $jobOffers->setCompanyId($row["companyId"]);
                        $jobOffers->setActive($row["active"]);
                        $jobOffers->setImage($row["image"]);
                    }
                }
                return $jobOffers;    
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        //Tambien se podria hacer el metodo de mofify con la limitacion de solo modificar el campo description en el caso de una company
        public function modify($jobOffers){

            try
            {
                    $query = "UPDATE ".$this->tableName." SET jobOffersId  = '".$jobOffers->getJobOffersId()."'".
                    ", jobPositionId = '".$jobOffers->getJobPositionId()."'".
                    ", descriptionOffers = '".$jobOffers->getDescription()."'".
                    // ", studentId = '".$jobOffers->getstudentId()."'".
                    ", companyId = '".$jobOffers->getCompanyId()."'".
                    ", image = '".$jobOffers->getImage()."'".
                    
                    " WHERE ".$this->tableName.".jobOffersId = '".$jobOffers->getJobOffersId()."'";
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

            }    
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function JobOfferFinalization($jobOfferId){

            try
            {
                $query = "UPDATE ".$this->tableName." SET active  = false WHERE jobOffersId = ".$jobOfferId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                 
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function DeclineStudent($jobOfferId,$studentId){

            try
            {
                $query = "DELETE FROM JobOffersForStudents WHERE (studentId = ".$studentId.") AND (jobOffersId =".$jobOfferId.")";

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                 
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function applyStudent($jobOffersId, $studentId){

            try
            {
                /*$query = "UPDATE ".$this->tableName." SET studentId  = '".$studentId."'".
                
                " WHERE ".$this->tableName.".jobOffersId = '".$jobOffers->getJobOffersId()."'";*/

                $query = "INSERT INTO JobOffersForStudents (jobOffersId, studentId) VALUES (:jobOffersId, :studentId)";

                $parameters["jobOffersId"] = $jobOffersId;
                $parameters["studentId"] = $studentId;
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters, 0);
                // $resultSet = $this->connection->Execute($query);

            }    
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function JobOffersById($id)
        {
            try
            {
                $jobOffers = null;
                
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".jobOffersId = '".$id."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {   
                               
                        $jobOffers = new JobOffers();
                    
                        $jobOffers->setJobOffersId($row["jobOffersId"]);
                        $jobOffers->setJobPositionId($row["jobPositionId"]);
                        $jobOffers->setDescription($row["descriptionOffers"]);
                        $jobOffers->setCompanyId($row["companyId"]);
                        $jobOffers->setActive($row["active"]);
                        $jobOffers->setImage($row["image"]);

                        $query2 = "SELECT studentId FROM JobOffersForStudents WHERE jobOffersId =".$row["jobOffersId"];
                        $this->connection = Connection::GetInstance();
                        $resultSet2 = $this->connection->Execute($query2);
                        foreach($resultSet2 as $row2){
                            $jobOffers->studentIdPush($row2["studentId"]);
                        }

                }
                return $jobOffers;  
                
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($id)
        {
            try{

                $query = "DELETE FROM ".$this->tableName." WHERE ".$this->tableName.".jobOffersId = '".$id."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

            
    }
?>