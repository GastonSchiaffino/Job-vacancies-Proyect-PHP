<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use DAO\Connection as Connection;
    use FFI\Exception;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();
        private $connection;
        private $tableName = "company";

        public function Add(Company $company)
        {
            return $this->SaveData($company);
        }

        private function SaveData(Company $company){

            try
            {
                $query = "INSERT INTO ".$this->tableName." ( cuit, nameCompany, yearFundation, city, descriptionCompany, logo, email, phoneNumber) VALUES (:cuit, :nameCompany, :yearFundation, :city, :descriptionCompany, :logo, :email, :phoneNumber);";

                $parameters["cuit"] = $company->getCuit();
                $parameters["nameCompany"] = $company->getName();
                $parameters["yearFundation"] = $company->getYearFundation();
                $parameters["city"] = $company->getCity();
                $parameters["descriptionCompany"] = $company->getDescription();
                $parameters["logo"] = $company->getLogo();
                $parameters["email"] = $company->getEmail();
                $parameters["phoneNumber"] = $company->getPhoneNumber();

                $this->connection = Connection::GetInstance();

                $responseConnection = $this->connection->ExecuteNonQuery($query, $parameters);

                return "EMPRESA REGISTRADA CORRECTAMENTE";
            }
            catch(Exception $ex)
            {
                return $ex->getMessage();
            }
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->companyList;
        }

        private function RetrieveData(){
            try
            {
                $this->companyList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new company();
                    $company->setCompanyId($row["companyId"]);
                    $company->setCuit($row["cuit"]);
                    $company->setName($row["nameCompany"]);
                    $company->setYearFundation($row["yearFundation"]);
                    $company->setCity($row["city"]);
                    $company->setDescription($row["descriptionCompany"]);
                    $company->setLogo($row["logo"]);
                    $company->setEmail($row["email"]);
                    $company->setPhoneNumber($row["phoneNumber"]);

                    array_push($this->companyList, $company);
                }

            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        // CompanyByCuit company por CUIT (se puede implementar con id tambien, lo hice así para ver si funcionaba y como estaba anteriormente con json)
        public function CompanyByCuit($cuit)
        {
            try
            {
                $company = null;
                
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".cuit = '".$cuit."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {   
                               
                        $company = new  Company();
                    
                        $company->setCompanyId($row["companyId"]);
                        $company->setCuit($row["cuit"]);
                        $company->setName($row["nameCompany"]);
                        $company->setYearFundation($row["yearFundation"]);
                        $company->setCity($row["city"]);
                        $company->setDescription($row["descriptionCompany"]);
                        $company->setLogo($row["logo"]);
                        $company->setEmail($row["email"]);
                        $company->setPhoneNumber($row["phoneNumber"]);
                    
                }
                return $company;  
                
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function CompanyById($companyId)
        {
            try
            {
                $company = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".companyId = '".$companyId."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {   
                               
                        $company = new  Company();

                        $company->setCompanyId($row["companyId"]);
                        $company->setCuit($row["cuit"]);
                        $company->setName($row["nameCompany"]);
                        $company->setYearFundation($row["yearFundation"]);
                        $company->setCity($row["city"]);
                        $company->setDescription($row["descriptionCompany"]);
                        $company->setLogo($row["logo"]);
                        $company->setEmail($row["email"]);
                        $company->setPhoneNumber($row["phoneNumber"]);
                    
                }
                return $company;  
                
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function CompanyByEmail($email)
        {
            try
            {
                $company = null;
                
                $query = "SELECT * FROM ".$this->tableName." WHERE ".$this->tableName.".email = '".$email."'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row)
                {   
                               
                        $company = new  Company();
                    
                        $company->setCompanyId($row["companyId"]);
                        $company->setCuit($row["cuit"]);
                        $company->setName($row["nameCompany"]);
                        $company->setYearFundation($row["yearFundation"]);
                        $company->setCity($row["city"]);
                        $company->setDescription($row["descriptionCompany"]);
                        $company->setLogo($row["logo"]);
                        $company->setEmail($row["email"]);
                        $company->setPhoneNumber($row["phoneNumber"]);
                    
                }
                return $company;  
                
            }    
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function SaveFileImage($tmp,$image){
            move_uploaded_file($tmp,$image);

        }

        ///modify COMPANY por CUIT (se puede implementar por companyId)
        public function modify($cuit,$company){

            $companyToModify=$this->CompanyByCuit($cuit);
            $this->deleteLogo($company,$companyToModify);

            try
            {
                $query = "UPDATE ".$this->tableName." SET cuit = '".$company->getCuit()."'".
                ", nameCompany = '".$company->getName()."'".
                ", yearFundation = ".$company->getYearFundation().
                ", city = '".$company->getCity()."'".
                ", descriptionCompany = '".$company->getDescription()."'".
                ", logo ='".$company->getLogo()."'".
                ", email = '".$company->getEmail()."'".
                ", phoneNumber = '".$company->getPhoneNumber()."'".
                " WHERE ".$this->tableName.".cuit = '".$cuit."'";
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                return "Empresa modificada correctamente";
            }    
            catch(Exception $ex)
            {
                return $ex->getMessage();
            }

        }

        
        public function deleteLogo($company,$companyToModify){
            if(empty($company->getLogo())){
                $company->setLogo($companyToModify->getLogo());
            }else{
               unlink("../".IMAGE_PATH. $companyToModify->getLogo());
            } 
        }
        
        
        public function existsByCuit($cuit){
            
            $array=$this->GetAll();

            $flag=false;

            for($i=0;($i<count($array))&&(!$flag);$i++){
                if($cuit==$array[$i]->getCuit()){
                    $flag=true;
                }
            }
            return $flag;
        }

        ///DELETE company por CUIT en BBD (se puede implementar con id tambien, lo hice así para ver si funcionaba y como estaba anteriormente con json)
        public function delete($cuit)
        {
            try{

                $query = "DELETE FROM ".$this->tableName." WHERE ".$this->tableName.".cuit = '".$cuit."'";

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