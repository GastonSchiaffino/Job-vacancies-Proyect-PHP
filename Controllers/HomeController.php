<?php
    namespace Controllers;

    use Models\Student as Student;
    use Models\Utils as Utils;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        }      
        public function Signin(){
            require_once(VIEWS_PATH."signin.php");
        }


        

        public function login($email,$pass){
       
            $studentController= new StudentController();
            $CompanyController = new CompanyController();
            $UserController= new UserController();

            $user=$UserController->UserByEmail($email);
           
            if(isset($user)&&($user->getPass()==$pass)){

                if($user->getUserType()=='admin'){
                    
                   $_SESSION['admin']=$email;
                     
                   $CompanyController->ShowListView();

                }
                else if($user->getUserType()=='student'){
                    
                   $student= $studentController->StudentById($user->getUser_id_api());

                   $_SESSION['student']=$student;

                   $studentController->ShowProfileView();

                }else {

                  $company= $CompanyController->CompanyByEmail($user->getEmail());

                  $_SESSION['company']=$company;
                            
                  require_once(VIEWS_PATH."company-detail.php");
                  //$companyController->ShowDetailView();     

                 
                }
            }else{
                $this->Index();       
            }
        }

        public function logout(){

            session_destroy();

            $this->Index();
        }




    }
?>