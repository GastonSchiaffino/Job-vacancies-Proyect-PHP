<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\Student as Student;
    use Models\Company as Company;
    use Models\Users as Users;

    class UserController{

        private $UserDAO;

        public function __construct (){
            $this->UserDAO= new UserDAO();
        }

        public function UserByEmail($email){

            $answer=$this->UserDAO->UserByEmail($email);

            return $answer;
        }

        public function AddStudentUser($email,$pass,$checkedPass){

            $homeController= new HomeController();

            if($pass==$checkedPass){

                $studentController=new StudentController;
                $student=new Student;

                $student=$studentController->StudentByEmail($email);

                if(isset($student)){

                    $user=new Users();

                    $user->setEmail($student->getEmail());
                    $user->setName($student->getFirstName()." ".$student->getLastName());
                    $user->setPass($pass);
                    $user->setUser_id_api($student->getStudentId());
                    $user->setUserType('student');

                    $this->UserDAO->Add($user);

                    $homeController->Index();
                    
                }else{
                    $_POST['validationEmail']="Correo Electronico no registrado.";
                }
                    
                
                $homeController->Signin();
            
            }else{
                $_POST['validationPass']="Las Contraseñas no coinciden.";
                $homeController->Signin();
            }

        }

        public function AddCompanyUser($company){

            //$homeController= new HomeController();

            //$companyController=new CompanyController();
            //$company=new Company();

            //$company= $companyController->CompanyByCuit($cuit);

            if(isset($company)){

                $user=new Users();

                $user->setEmail($company->getEmail());
                $user->setName($company->getName());
                $user->setPass($company->getCuit());
                
                $user->setUserType('company');

                $this->UserDAO->Add($user);

                //$homeController->Index();
            }
        }

        public function delete($email){
            $this->UserDAO->delete($email);
        }

    }




?>