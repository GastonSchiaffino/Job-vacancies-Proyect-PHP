<?php
    namespace Controllers;

    use Utils\Utils as Utils;
    use DAO\CompanyDAO as CompanyDAO;
    use Models\Company as Company;
    use Controllers\UserController as UserController;

    class CompanyController
    {
        private $companyDAO;

        public function __construct()
        {
            $this->companyDAO = new CompanyDAO();
        }

        public function ShowAddView($response = "")
        {
            Utils::checkSessionAdmin();

            require_once(VIEWS_PATH."company-add.php");
        }

        public function ShowListView($response = "")
        {
            Utils::checkSessionStudent();

            $companyList = $this->companyDAO->GetAll();

            require_once(VIEWS_PATH."company-list.php");
        }

        public function ShowDetailView($button)
        {
            $arrayAction = explode(",",$button);
        
            if(isset($arrayAction)){
                if($arrayAction[1]=="ver"){
                    $company= $this->companyDAO->CompanyByCuit($arrayAction[0]);
                    require_once(VIEWS_PATH."company-detail.php");
                }    
            }    
        }

        public function ShowModifyView($response = "")
        {
            Utils::checkSessionStudent();

            require_once(VIEWS_PATH."company-modify.php");
        }

        public function existsByCuit($cuit){
            $answer=$this->companyDAO->existsByCuit($cuit);
            return $answer;
        }

        public function CompanyById($companyId){
            $answer=$this->companyDAO->CompanyById($companyId);
            return $answer;
        }

        public function CompanyByCuit($cuit){
            $answer=$this->companyDAO->CompanyByCuit($cuit);
            return $answer;
        }

        public function CompanyByEmail($email){
            $answer=$this->companyDAO->CompanyByEmail($email);
            return $answer;
        }


        public function GetAll(){
            $answer=$this->companyDAO->GetAll();
            return $answer;
        }


        public function Add($name,$yearFundation,$city,$description,$logo,$email,$phoneNumber,$cuit)
        {
            Utils::checkSessionAdmin();

            $tmp = ($logo['tmp_name']);
            $image = "Assets/Image/".$logo['name'];
            
           
            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setYearFundation($yearFundation);
            $company->setCity($city);
            $company->setDescription($description);
            $company->setLogo($logo['name']);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);

            
            if($this->validateDate($yearFundation)){
                if(strlen($cuit)==11){
                    if($this->cuitValidate($cuit)){
                        if(!$this->existsByCuit($cuit)){

                                $response = $this->companyDAO->Add($company);

                                $this->companyDAO->SaveFileImage($tmp,$image);

                                $user= new UserController();
                                $user->AddCompanyUser($company);
                               
                                $this->ShowListView($response);
                        }else{
                            $response ="Cuit Registrado.";
                        }
                    }else{
                        $response ="Cuit Incorrecto.";
                    }	
                }else{
                    $response ="El Cuit debe ser de 11 dígitos.";
                }	   
            }
            else{
                $response ="Año invalido.";
            }         
            
            $this->ShowAddView($response);

            
        }

        public function validateDate($date){
            $year_entered = date("Y");
            $flag= false;
            
            //Corrobora que sea un numero sin decimales
            if(ctype_digit($date)){
                if((0 < $date) && $year_entered >= $date)
	            {
                    $flag= true;
                }
            }

            return $flag;
        }



        public function Action($button){
            Utils::checkSessionAdmin();

            $arrayAction = explode(",",$button);
            
            if(isset($arrayAction)){
                if($arrayAction[1]=="remove"){
                    $company= $this->CompanyByCuit($arrayAction[0]);
                    $userController= new UserController();
                    $userController->delete($company->getEmail());
                    $this->companyDAO->delete($arrayAction[0]);
                    
                    $this->ShowListView();
                }elseif($arrayAction[1]=="modify"){
                    $company= $this->companyDAO->CompanyByCuit($arrayAction[0]);
                    require_once(VIEWS_PATH."company-modify.php");
                }
            }
        }
        
        public function ModifyCompany($name,$yearFundation,$city,$description,$logo,$email,$phoneNumber,$cuit){
            Utils::checkSessionAdmin();

            $tmp = ($logo['tmp_name']);
            $image = "Assets/Image/".$logo['name'];
            move_uploaded_file($tmp,$image);
            
            $company = new Company();
            $company->setName($name);
            $company->setCuit($cuit);
            $company->setYearFundation($yearFundation);
            $company->setCity($city);
            $company->setDescription($description);
            $company->setLogo($logo['name']);
            $company->setEmail($email);
            $company->setPhoneNumber($phoneNumber);

            if($this->validateDate($yearFundation)){

                $response = $this->companyDAO->modify($cuit,$company);
               
                $this->ShowListView($response);
		    }
            else{
                $_POST['validationDate'] = "Año invalido.";
                require_once(VIEWS_PATH."company-modify.php");
            } 
        }

        public function CompanyListByName ($name){

            $companyListDAO=$this->companyDAO->getAll();

            $companyList = array();
            $name=trim($name);
            foreach ($companyListDAO as $value){
                if(strncasecmp($name,  $value->getName(), strlen($name))==0){
                    array_push($companyList,$value);
                }
            }

            require_once(VIEWS_PATH."company-list.php");
        }

        public function cuitValidate($cuit){

            $cuitArray=str_split($cuit);
            
            $answer=false;  
           
            $cuitReverse=array_reverse($cuitArray);
       
            $lastDigit = array_shift($cuitReverse);
       
            //sumatoria
            $sum=0;
            $i=2;
            foreach($cuitReverse as $digit){
       
                if($i>7){
                    $i=2;
                }
       
                $sum = $sum + ($digit * $i);
                $i++;
            }
    
            //mod11
            $mod11 = ($sum % 11);
            //11 - mod11
            $lastControl = 11 - $mod11;

            //casos
            if($lastControl==11){
                $lastControl=0;
            }else if($lastControl==10){
                $lastControl=1;
            }
            
            //control final
            if($lastDigit==$lastControl){
                $answer=true;
            }
            
            return $answer;
        }
        
    }
?>
        
