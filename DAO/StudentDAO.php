<?php
    namespace DAO;

    use Utils\Utils as Utils;
    use DAO\IStudentDAO as IStudentDAO;
    use Models\Student as Student;

    class StudentDAO implements IStudentDAO
    {
        private $studentList = array();


        public function existsByEmail($email){

            $array=$this->GetAll();

            $flag=false;

            for($i=0;($i<count($array))&&(!$flag);$i++){
                if($email==$array[$i]->getEmail()){
                    $flag=true;
                }
            }
            return $flag;
        }

        public function StudentByEmail ($email) {
            $array=$this->GetAll();
            
            $flag=false;
            $student= null;

            for($i=0;($i<count($array))&&(!$flag);$i++){
                if($email==$array[$i]->getEmail()){
                    $flag=true;
                    $student = $array[$i];
                }
            }
            return $student;
        }

        public function StudentById($id)
        {
            $array=$this->GetAll();
            
            $flag=false;
            $student= new Student;

            for($i=0;($i<count($array))&&(!$flag);$i++){
                if($id==$array[$i]->getStudentId()){
                    $flag=true;
                    $student = $array[$i];
                }
            }
            return $student;
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->studentList;
        }

        private function RetrieveData()
        {
            $this->studentList = array();

            $arrayToDecode = Utils::apiConsume("Student");
            
            foreach($arrayToDecode as $valuesArray)
            {
                    $student = new Student();

                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setActive($valuesArray["active"]);
                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setCareerId($valuesArray["careerId"]);
                    $student->setFileNumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setPhoneNumber($valuesArray["phoneNumber"]);
                            
                    array_push($this->studentList, $student);
            }
                      
        }

    }
?>