<?php
    require_once('nav.php');

    use Controllers\CompanyController;
    use Controllers\JobPositionController as JobPositionController;
    use Controllers\CareerController as CareerController; 
    use Controllers\StudentController;
    use Controllers\JobOffersController as JobOffersController;

    $companyController= new CompanyController();
    $jobPositionController= new JobPositionController();
    $careerController= new CareerController();
    $studentController= new StudentController();
     $jobOffersController = new JobOffersController();

    $arrayCareer= $careerController->GetAll();
    $arrayJobPosition=$jobPositionController->GetAll();
    $studentList=$studentController->GetAll();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container ">
               <?php if(!empty($jobOffers->getImage())){?>
               <div><img class="image" src="<?php echo IMAGE_PATH.$jobOffers->getImage();?>" width="100%" height="450px"></div><br>
               <?php } ?>
               <h1 class="mb-4"><img class="img-thumbnail" src="<?php echo IMAGE_PATH.$companyController->CompanyById($jobOffers->getCompanyId())->getLogo();?>"><?php echo " ".$companyController->CompanyById($jobOffers->getCompanyId())->getName(); ?></p></h1>
               <table class="table bg-light-alpha border border-secondary">
                    <thead>
                         <!-- <th class="border border-secondary border-right-0 border-left-0">Logo</> -->
                         <th class="border border-secondary border-right-0 border-left-0">Puesto</th>
                         <th class="border border-secondary border-right-0 border-left-0">Carrera</th>

                         <?php if((isset($_SESSION['company'])||isset($_SESSION['admin']))&&(empty($jobOffers->getStudentId()))){?>
                         <th class="border border-secondary border-right-0 border-left-0">Estudiante</th>
                         <?php } ?>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                    </thead>
                    <tbody>
                       <form action= "<?php echo FRONT_ROOT ?>JobOffers/Action" method="POST">
                              <tr>
                                   
                                   <td><?php echo $jobPositionController->JobPositionById($jobOffers->getJobPositionId(),$arrayJobPosition)->getDescription(); ?></td>
                                   <td><?php echo $careerController->CareerById(($jobPositionController->JobPositionById($jobOffers->getJobPositionId(),$arrayJobPosition))->getCareerId(),$arrayCareer)->getDescription(); ?></td>
                            
                                   <?php if(isset($_SESSION['company'])||isset($_SESSION['admin'])){
                                              if(empty($jobOffers->getStudentId())){?>
                                             <td>Sin postulantes</td>
                                        <td> 
                                             <button type="submit" name="button" class="btn btn-success" value="<?php echo $jobOffers->getJobOffersId().",modify"; ?>"> Modificar </button> 
                                        </td>
                                        <td> 
                                             <button type="submit" name="button" class="btn btn-danger" value="<?php echo $jobOffers->getJobOffersId().",remove"; ?>"> Eliminar </button>
                                        </td>
                                        <?php if ($jobOffers->getActive()) { ?>
                                        <td> 
                                             <button type="submit" name="button" class="btn btn-primary" value="<?php echo $jobOffers->getJobOffersId().",finalize"; ?>"> Finalizar </button>
                                        </td>
                                        <?php } ?>
                                         <?php }else { ?>
                                        <td>
                                        <button type="submit" name="button" class="btn btn-primary" value="<?php echo $jobOffers->getJobOffersId().",pdf"; ?>"> Generar pdf </button>
                                        </td>
                                        <?php
                                             if ($jobOffers->getActive()) { ?>
                                        <td> 
                                       <td> 
                                       <button type="submit" name="button" class="btn btn-primary" value="<?php echo $jobOffers->getJobOffersId().",finalize"; ?>"> Finalizar </button>
                                       </td>
                                       <?php } ?>
                                   <?php }
                                   }else if (isset($_SESSION['student'])){?>
                                        <td> <?php
                                             if(!in_array($_SESSION["student"]->getStudentId(),$jobOffers->getStudentId())){
                                                  if($jobOffers->getActive()){
                                             ?>
                                             <button type="submit" name="button" class="btn btn-success" value="<?php echo $jobOffers->getJobOffersId().",apply"; ?>"> Aplicar </button> 
                                        </td>
                                  <?php }
                                        }else{?>                      
                                        <td>
                                             <p class="text-success">Aplicaste a esta oferta Laboral</p>
                                        </td>
                                  <?php }
                              } ?>
                              </tr>              
                         </form>
                         </tr>
                    </tbody>
               </table>
                              <div class="form-group">
                                   <b><label class="text-dark"> Descripción </label></b>
                                   <textarea  class="form-control" name="description" rows="15" required><?php echo $jobOffers->getDescription() ?></textarea>
                              </div>

                    <?php if((isset($_SESSION['company'])||isset($_SESSION['admin']))&&(!empty($jobOffers->getStudentId()))){?>
                    <div class="form-group"> 
                    <table class="table bg-light-alpha">
                    <thead>
                         <th>Apellido</th>
                         <th>Nombre</th>
                         <th>DNI</th>
                         <th>Email</th>
                         <th>Fecha de nacimiento</th>
                         <th>Telefono</th>
                         <th>Carrera</th>
                    </thead>
                    <tbody>
                         <?php
                        //die(var_dump(count($studentList)));
                         foreach($jobOffers->getStudentId() as $studentId){
                              $flag=0;
                              for($i=0;($i<count($studentList))&& $flag!=1;$i++){
                              if($studentId==$studentList[$i]->getStudentId()){
                                   $flag=1;
                                   ?>
                                        <tr>
                                             <td><?php echo $studentList[$i]->getLastName() ?></td>
                                             <td><?php echo $studentList[$i]->getFirstName() ?></td>
                                             <td><?php echo $studentList[$i]->getDni() ?></td>
                                             <td><?php echo $studentList[$i]->getEmail() ?></td>
                                             <td><?php echo $studentList[$i]->getBirthDate() ?></td>
                                             <td><?php echo $studentList[$i]->getPhoneNumber() ?></td>
                                             <td><?php echo $careerController->CareerById($studentList[$i]->getCareerId(),$arrayCareer)->getDescription();?></td>
                                             <form action= "<?php echo FRONT_ROOT ?>JobOffers/DeclineStudent" method="POST">  
                                              <?php if (isset($_SESSION['admin'])) { ?>
                                             <td> 
                                             <button type="submit" name="button" class="btn btn-danger" value="<?php echo $studentList[$i]->getStudentId().",".$jobOffers->getJobOffersId(); ?>"> Declinar </button>
                                             </td>
                                             <?php } ?>
                                             </form>
                                        </tr>
                                   <?php
                              }
                         }
                    }
                         ?>
                         </tr>
                    </tbody>
               </table>
               </div>
               <?php } ?>
               
          </div>
     </section>
</main>