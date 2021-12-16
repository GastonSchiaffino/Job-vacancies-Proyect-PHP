<?php

    namespace Controllers;

    use Utils\Utils as Utils;
    use DAO\JobOffersDAO as JobOffersDAO;
    use Models\JobOffers as JobOffers;
    use Models\Student as Student;
    use Models\Company as Company;
    use FPDF\FPDF as FPDF;
    
    //die(var_dump(new FPDF));
    //
    
    class JobOffersController{

    
        private $JobOffersDAO;

        public function __construct()
        {
            $this->JobOffersDAO = new JobOffersDAO();
        }

        public function ShowAddView()
        {   
            Utils::checkSessionCompany();
            require_once(VIEWS_PATH."joboffers-add.php");
        }

        public function ShowListView($response="")
        {   
            Utils::checkSessionStudent();

            $carrerController= new CareerController();
            $jobPositionController=new JobPositionController();

            $jobOffersList = $this->JobOffersDAO->GetAll();
           
            require_once(VIEWS_PATH."joboffers-list.php");
        }

        public function ShowDetailView($button)
        {
            $jobOffers= $this->JobOffersDAO->JobOffersById($button);
            
            require_once(VIEWS_PATH."joboffers-detail.php");   
        }

        public function GetAll(){
            return $this->JobOffersDAO->GetAll();
        }
        
        public function Add($jobPositionId,$description, $companyId,$image)
        {
           
            Utils::checkSessionCompany();
            $jobOffers = new JobOffers();
            $tmp = ($image['tmp_name']);
            $dirimage = "Assets/Image/".$image['name'];
            move_uploaded_file($tmp,$dirimage);
    
            
            $jobOffers->setJobPositionId($jobPositionId);
            $jobOffers->setDescription($description);
            $jobOffers->setCompanyId($companyId);
            $jobOffers->setActive(true);
            $jobOffers->setImage($image['name']);
           
            $response = $this->JobOffersDAO->Add($jobOffers);

            $this->ShowListView($response);
        }

        public function JobOffersListByJobPosition ($id){

            $jobOffersDao=$this->JobOffersDAO->getAll();

            $jobOffersList = array();
            
            foreach ($jobOffersDao as $value){
                if($id==$value->getJobPositionId()){
                    array_push($jobOffersList,$value);
                }
            }
            $jobPositionId= $id;
            require_once(VIEWS_PATH."joboffers-list.php");
        }

        public function JobOffersListByCareerId($careerId){

            $jobOffersDao=$this->JobOffersDAO->getAll();

            $jobPositionController = new JobPositionController();
            $arrayJobPosition=$jobPositionController->GetAll();


            $jobOffersList = array();
            
            foreach ($jobOffersDao as $value){

                $jobPosition=$jobPositionController->JobPositionById($value->getJobPositionId(),$arrayJobPosition);

                if($careerId==$jobPosition->getCareerId()){
                    array_push($jobOffersList,$value);
                }
            }
            $idCareer= $careerId;
        
          require_once(VIEWS_PATH."joboffers-list.php");
        }

        public function Action($button){
            Utils::checkSessionStudent();
            
            $arrayAction = explode(",",$button);
           
            if(isset($arrayAction)){
                if($arrayAction[1]=="remove"){
                    $this->JobOffersDAO->delete($arrayAction[0]);
                    $this->ShowListView();
                }elseif($arrayAction[1]=="modify"){
                    $jobOffers= $this->JobOffersDAO->JobOffersById($arrayAction[0]);
                    require_once(VIEWS_PATH."joboffers-modify.php");
                }elseif($arrayAction[1]=="apply"){
                    $jobOffers= $arrayAction[0];
                    $this->JobOffersDAO->applyStudent($jobOffers,($_SESSION['student']->getStudentId()));
                    
                    $response = "APLICACIÓN REGISTRADA.";  
                
                    $this->ShowListView($response);

                }elseif ($arrayAction[1]=="finalize"){
                    $this->JobOffersDAO->JobOfferFinalization($arrayAction[0]);
                    $descriptionEmail= "Gracias por postularte a nuestra oferta laboral.\n";
                    $this->sendEmail($arrayAction[0], $descriptionEmail);
        
                    $response = "OFERTA FINALIZADA.";  
                   
                    $this->ShowListView($response);
                }else if($arrayAction[1]=="pdf"){
                    $this->createPDF($arrayAction[0]);
                }
            }
        }

        public function DeclineStudent($button){
            $arrayAction = explode(",",$button);

            $descriptionEmail= "Lamentablemente tu postulación fue declinada, ya que no cumples con los requisitos de la búsqueda laboral.\n";
            $this->sendEmail($arrayAction[1], $descriptionEmail);

            $this->JobOffersDAO->DeclineStudent($arrayAction[1],$arrayAction[0]);

             $response = "ESTUDIANTE ELIMINADO DE LA OFERTA.";  
           
             $this->ShowListView($response);
        }
        
        public function ModifyJobOffers($jobOffersId,$jobPositionId, $description,$studentId, $companyId,$image){
            Utils::checkSessionCompany();

            $jobOffers = new JobOffers();
            $jobOffers->setJobOffersId($jobOffersId);
            $jobOffers->setJobPositionId($jobPositionId);
            $jobOffers->setDescription($description);
            $tmp = ($image['tmp_name']);
            $dirimage = "Assets/Image/".$image['name'];
            move_uploaded_file($tmp,$dirimage);
            $jobOffers->setImage($image['name']);

            if($studentId>0)
             $jobOffers->setStudentId($studentId);

            $jobOffers->setCompanyId($companyId);
           
            $this->JobOffersDAO->modify($jobOffers);
       
            $response = "OFERTA LABORAL MODIFICADA.";  
          
            $this->ShowListView($response);

        }

        public function sendEmail($id, $descriptionEmail){
            $jobOfferSearch= new JobOffersDAO();
            $jobOffer= new JobOffers();
            $company= new Company();        
            $companySearch= new CompanyController();
            $student= new StudentController();

            $jobOffer= $jobOfferSearch->JobOffersById($id);
            $company= $companySearch->CompanyById($jobOffer->getCompanyId());                

            foreach($jobOffer->getStudentId() as $value){
                //$to= "mostafalucas@hotmail.com.ar";
                $to= ($student->StudentById($value)->getEmail());
                $subject= $company->getName();
                $message= $descriptionEmail."\nDescripcion de la oferta:\n".$jobOffer->getDescription();
                $from= "tpfinallaviv@gmail.com";
                    
                mail($to, $subject, $message, $from);
            }
        }

        public function createPDF($id){
            $pdf=new FPDF();
            $jobOfferSearch= new JobOffersDAO();
            $jobOffer= new JobOffers();
            $jobPositionController=new JobPositionController();
            $company= new Company(); 
            $companySearch= new CompanyController();
            $studentController= new StudentController(); 
            $postulante =new Student();   


            $jobOffer= $jobOfferSearch->JobOffersById($id);
            $company= $companySearch->CompanyById($jobOffer->getCompanyId());
            $arrayJobPosition=$jobPositionController->GetAll();
            ob_end_clean();
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(66,20,$company->getName(),0,1,'C',0);
            $pdf->Image("C:\\xampp\htdocs".IMAGE_PATH.$company->getLogo(),10,10,0,0,'png');
            $pdf->Cell(40,20,"Puesto: ".($jobPositionController->JobPositionById($jobOffer->getJobPositionId(),$arrayJobPosition))->getDescription(),0,1,'L',0);
            $pdf->Cell(0,10,"Postulantes",0,1,'L',0);
            $pdf->SetFont('Arial','B',8);
             foreach($jobOffer->getStudentId() as $value){
                $postulante=$studentController->StudentById($value);
                $pdf->Cell(20,10,$postulante->getLastName(),1,0,'C',0);
                $pdf->Cell(20,10,$postulante->getFirstName(),1,0,'C',0);
                $pdf->Cell(30,10,$postulante->getDni(),1,0,'C',0);
                $pdf->Cell(40,10,$postulante->getEmail(),1,0,'C',0);
                $pdf->Cell(40,10,$postulante->getBirthDate(),1,0,'C',0);
                $pdf->Cell(30,10,$postulante->getPhoneNumber(),1,1,'C',0);
            }
            $pdf->Output();
           
        }

      
        
    }
?>