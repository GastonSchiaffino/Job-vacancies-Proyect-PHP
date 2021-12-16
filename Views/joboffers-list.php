<?php

     require_once('nav.php');   
     use Controllers\CareerController as CareerController; 
     use Controllers\JobPositionController as JobPositionController;
//   use Controllers\JobOffersController as JobOffersController;
     use Controllers\CompanyController as CompanyController;
     use Models\Career as Career;
     use Models\JobPosition;

     $jobPositionController= new JobPositionController();
     $companyController= new CompanyController();
     $careerController= new CareerController();
     $career= new Career();
     $job= new JobPosition();

     $arrayCareer= $careerController->GetAll();
     $arrayJobPosition=$jobPositionController->GetAll();
     
     if(!empty($idCareer)){
          $career= $careerController->CareerById($idCareer, $arrayCareer);
     }
     if(!empty($jobPositionId)){
          $job= $jobPositionController->JobPositionById($jobPositionId, $arrayJobPosition);
     }
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de Ofertas Laborales</h2>

               <?php if($response!=""){?>
                    <p class="alert alert-sucess"><?php echo $response ?><p>
               <?php } ?> 

               <form class="form-inline" action="<?php echo FRONT_ROOT ?>JobOffers/JobOffersListByCareerId" methos="get">
                     <select name="carrerId" class="form-control mr-sm-2" required>
                         <?php if(!empty($idCareer)){ ?>
                              <option value="<?php echo $career->getCareerId();?>"><?php echo $career->getDescription();?></option>
                         <?php };?>
                         <?php foreach($arrayCareer as $value){ ?>
                              <option value="<?php echo $value->getCareerId();?>"><?php echo $value->getDescription();?></option>
                         <?php };?>
                     </select>
                    <button class="btn my-2" type="submit" >Filtrar</button>
               </form>
               <form class="form-inline" action="<?php echo FRONT_ROOT ?>JobOffers/JobOffersListByJobPosition" methos="get">
                     <select name="jobPositionId" class="form-control mr-sm-2" required>
                         <?php if(!empty($jobPositionId)){ ?>
                              <option value="<?php echo $job->getJobPositionID();?>"><?php echo $job->getDescription();?></option>
                         <?php };?>
                         <?php foreach($arrayJobPosition as $value){ ?>
                              <option value="<?php echo $value->getJobPositionId();?>"><?php echo $value->getDescription();?></option>
                         <?php };?>
                     </select>
                    <button class="btn my-2" type="submit" >Filtrar</button>
               </form>

               <form action="<?php echo FRONT_ROOT ?>JobOffers/ShowDetailView" method="get">
                    <div class="row row-cols-4">
                         <?php
                          if(isset($_SESSION['student'])){
                               if(!empty($jobOffersList)){
                              foreach($jobOffersList as $values){ 
                         ?>   

                                   <ul>
                                        <div class="card h-100" style="width: 18rem;">
                                        <img class="img-thumbnail rounded mx-auto d-block" style="width: 64px; height:64px;" src="<?php echo IMAGE_PATH.$companyController->CompanyById($values->getCompanyId())->getLogo();?>">
                                             <span class="card-body">
                                             <h5 class="card-title"><?php echo $jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition)->getDescription(); ?></h5>
                                             <p class="card-text"><?php echo $companyController->CompanyById($values->getCompanyId())->getName(); ?></p>
                                             <p class="card-text"><?php echo $careerController->CareerById(($jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition))->getCareerId(),$arrayCareer)->getDescription(); ?></p>

                                             <?php if($values->getActive()){ ?> 
                                                  <p class="card-text text-success">Abierta</p>
                                             <?php } else{ ?>
                                                  <p class="card-text text-danger">Finalizada</p>
                                             <?php } ?>

                                             <button type="submit" name="button" value="<?php echo $values->getJobOffersId(); ?>" class="btn btn-primary rounded mx-auto d-block ">Ver Oferta</button>
                                             </span>
                                             </div>
                                   </ul>
                                  <?php
                                   }
                              }else{
                                   echo "<br>No hubo resultados para la búsqueda :(";
                              }
                         }
                         ?>
                         <?php
                          if(isset($_SESSION['admin'])){
                              if(!empty($jobOffersList)){
                              foreach($jobOffersList as $values)
                              {
                                   ?>   
                                   <ul> 
                                        <!-- <div class="col-4"> -->
                                        <div class="card h-100" style="width: 18rem;">
                                        <img class="img-thumbnail rounded mx-auto d-block" style="width: 64px; height:64px;" src="<?php echo IMAGE_PATH.$companyController->CompanyById($values->getCompanyId())->getLogo();?>">
                                             <span class="card-body">
                                             <h5 class="card-title"><?php echo $jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition)->getDescription(); ?></h5>
                                             <p class="card-text"><?php echo $companyController->CompanyById($values->getCompanyId())->getName(); ?></p>
                                             <p class="card-text"><?php echo $careerController->CareerById(($jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition))->getCareerId(),$arrayCareer)->getDescription(); ?></p>

                                             <?php if($values->getActive()){ ?> 
                                                  <p class="card-text text-success">Abierta</p>
                                             <?php } else{ ?>
                                                  <p class="card-text text-danger">Finalizada</p>
                                             <?php } ?>

                                             <button type="submit" name="button" value="<?php echo $values->getJobOffersId(); ?>" class="btn btn-primary rounded mx-auto d-block ">Ver Oferta</button>
                                             </span>
                                             </div>
                                        <!-- </div> -->
                                   </ul>
                                   <?php
                              }
                         }else{
                              echo "<br>No hubo resultados para la búsqueda :(";
                         }
                         }
                         ?>
                         <?php
                          if(isset($_SESSION['company'])){
                              foreach($jobOffersList as $values)
                              {
                                  if($_SESSION['company']->getCompanyId()==$values->getCompanyId()){
                                   ?>   
                                        <div class="card h-100" style="width: 18rem;">
                                        <img class="img-thumbnail rounded mx-auto d-block" style="width: 64px; height:64px;" src="<?php echo IMAGE_PATH.$companyController->CompanyById($values->getCompanyId())->getLogo();?>">
                                             <span class="card-body">
                                             <h5 class="card-title"><?php echo $jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition)->getDescription(); ?></h5>
                                             <p class="card-text"><?php echo $companyController->CompanyById($values->getCompanyId())->getName(); ?></p>
                                             <p class="card-text"><?php echo $careerController->CareerById(($jobPositionController->JobPositionById($values->getJobPositionId(),$arrayJobPosition))->getCareerId(),$arrayCareer)->getDescription(); ?></p>

                                             <?php if($values->getActive()){ ?> 
                                                  <p class="card-text text-success">Abierta</p>
                                             <?php } else{ ?>
                                                  <p class="card-text text-danger">Finalizada</p>
                                             <?php } ?>
                                             
                                             <button type="submit" name="button" value="<?php echo $values->getJobOffersId(); ?>" class="btn btn-primary rounded mx-auto d-block ">Ver Oferta</button>
                                             </span>
                                             </div>
                                   <?php
                                    }
                              }
                         }
                         ?>

                    </div>
               </form>
     </section>
</main>