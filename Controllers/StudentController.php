<?php
    namespace Controllers;

    use Utils\Utils as Utils;
    use DAO\StudentDAO as StudentDAO;
    use Models\Student as Student;
    use Controllers\CareerController as CareerController;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        public function ShowAddView()
        {   
            Utils::checkSessionAdmin();
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {   
            Utils::checkSessionAdmin();

            $studentList = $this->studentDAO->GetAll();
            $careerController= new CareerController();
            $arrayCareer=array();
            $arrayCareer=$careerController->GetAll();

            require_once(VIEWS_PATH."student-list.php");
        }

        public function ShowProfileView()
        {   
            Utils::checkSessionStudent();

            $student = $this->studentDAO->StudentByEmail($_SESSION["student"]->getEmail());
            $careerController= new CareerController();
            $arrayCareer=array();
            $arrayCareer=$careerController->GetAll();

            require_once(VIEWS_PATH."student-profile.php");
        }

        public function existsByEmail($Student){
            $answer=$this->studentDAO->existsByEmail($Student->getEmail());
            return $answer;
        }

        public function StudentByEmail($email){
            $answer=$this->studentDAO->StudentByEmail($email);
            return $answer;
        }

        
        public function StudentById($id)
        {
            $answer=$this->studentDAO->StudentById($id);
            return $answer;

        }

        public function GetAll(){
            return $studentList = $this->studentDAO->GetAll();
        }
    }
?>