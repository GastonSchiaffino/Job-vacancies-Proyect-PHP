<?php

     require_once('nav.php');

     use Controllers\JobPositionController as JobPositionController;
     use Controllers\CompanyController as CompanyController;
     use Controllers\JobOffersController;
     use Models\JobPosition;
    
     $jobPositionController= new JobPositionController();
     $CompanyController=new CompanyController;
     $jobPosition= new JobPosition();
     $jobPosition= $jobPositionController->JobPositionById($jobOffers->getJobPositionID(),$jobPositionController->GetAll());
     $company= $CompanyController->CompanyById($jobOffers->getCompanyId());
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

               <h2 class="mb-4">Editar Datos de la Oferta de Trabajo</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffers/ModifyJobOffers" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">

                    <div class="row">     
                         
                          <input type="number" name="jobOffersId" value="<?php echo $jobOffers->getJobOffersId()?>" hidden>       
                          <input type="number" name="studentId" value="<?php echo $jobOffers->getStudentId()?>" hidden>                 
                         <div class="col-lg-4">
                              <div class="form-group">
                                    <label for="">Puesto de Trabajo</label>
                                    <select name="jobPositionId" class="form-control" required>
                                    <option value="<?php echo $jobOffers->getJobPositionId();?>"><?php echo $jobPosition->getDescription();?></option>     
                                    <?php foreach($jobPosition=$jobPositionController->GetAll() as $value){ ?>
                                        <option value="<?php echo $value->getJobPositionId();?>"><?php echo $value->getDescription();?></option>
                                    <?php };?>
                                    </select>
                              </div>
                         </div>
                         <?php if (!isset($_SESSION['company'])){?>
                         <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Companía</label>
                                    <select name="companyId" class="form-control" required>
                                    <option value="<?php echo $jobOffers->getCompanyId();?>"><?php echo $company->getName();?></option>
                                    <?php 
                                        foreach($company=$CompanyController->GetAll() as $value){ ?>
                                        <option value="<?php echo $value->getCompanyId();?>"><?php echo $value->getName();?></option>
                                    <?php }?>

                                    </select>
                                </div>
                         </div>
                         <?php }else{ ?>
                               <input type="number" name="companyId" value="<?php echo ($_SESSION['company'])->getCompanyId();?>" hidden> 
                         <?php  };?>
                    </div>
                         <div class="form-group">
                              <label for="">Descripción</label>
                              <textarea class="form-control" rows="15" name="description" class="form-control" rows="3" required><?php echo $jobOffers->getDescription()?></textarea>
                         </div>
                         <div class="form-group">
                                   <b><label for="">Flyer</label></b>
                                   <input class="form-control-file" type="file" name="image" accept="image/png, .jpeg, .jpg, image/gif">
                                   <span>Archivo cargado: <?php echo $jobOffers->getImage();?></span>
                              </div>
                    
                    <button type="submit" class="btn btn-dark ml-auto d-block">Guardar Cambios</button>

               </form>
          </div>
     </section>
</main>