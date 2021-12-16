<?php

    require_once('nav.php');

    use Controllers\JobPositionController as JobPositionController;
    $JobPositionController = new JobPositionController();

    use Controllers\CompanyController as CompanyController;
    $CompanyController=new CompanyController;

    use Models\Company as Company;
    
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Oferta Laboral</h2>
               <form action="<?php echo FRONT_ROOT ?>JobOffers/Add" method="post"  enctype="multipart/form-data" class="bg-light-alpha p-5">
                    <div class="row"> 
                          <?php if(isset($_SESSION['admin'])){?>
                              <div class="col-lg-4">
                                   <div class="form-group">
                                        <b><label for="">Empresas</label></b>
                                        <select name="companyId" class="form-control" required>
                                        <?php foreach($company=$CompanyController->GetAll() as $value){ ?>
                                             <option value="<?php echo $value->getCompanyId();?>"><?php echo $value->getName();?></option>
                                        <?php };?>
                                        
                                        </select>
                                   </div>
                              </div>
                         <?php }else if(isset($_SESSION['company'])){
                                    ?>
                                   <input type="number" name="companyId" value="<?php echo $_SESSION['company']->getCompanyId();?>" class="form-control" hidden> 

                          <?php } ?>

                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Puesto de Trabajo</label></b>
                                   <select name="jobPositionId" class="form-control" required>
                                   <?php foreach($jobPosition=$JobPositionController->GetAll() as $value){?>
                                        <option value="<?php echo $value->getJobPositionId();?>"><?php echo $value->getDescription();?></option>
                                   <?php };?>

                                   </select>
                              </div>
                         </div>
                    </div>
                              <div class="form-group">
                                   <b><label for=""> Descripción </label></b> 
                                   <textarea  class="form-control" name="description" value="" rows="3" required></textarea>
                              </div>
                              
                              <div class="form-group">
                                   <b><label for="">Flyer</label></b>
                                   <input class="form-control-file" type="file" name="image" accept="image/png, .jpeg, .jpg, image/gif">
                              </div>
               
                        

                    
                    <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>