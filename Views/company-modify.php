<?php
    require_once('nav.php');

    use Controllers\CompanyController as CompanyController;
    
    $companyController= new CompanyController();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">

               <h2 class="mb-4">Editar Datos de compañía</h2>
               <form action="<?php echo FRONT_ROOT ?>Company/ModifyCompany" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">

                    <div class="row">                         
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Cuit</label></b>
                                   <input type="number" name="cuit" value="<?php echo $company->getCuit()?>" class="form-control" readonly >
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Nombre</label></b>
                                   <input type="text" name="name" value="<?php echo $company->getName()?>" class="form-control" >
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Año de Fundación</label></b>
                                   <input type="number" name="yearFundation" value="<?php echo $company->getYearFundation()?>" class="form-control" required >
                                   <?php
                                   
                                   if(isset($_POST['validationDate'])) {?>
                                        <p class="alert alert-danger"><?php echo $_POST['validationDate'] ?><p>
                                   <?php } ?>  
                    
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Ciudad</label></b>
                                   <input type="text" name="city" value="<?php echo $company->getCity()?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Correo Electrónico</label></b>
                                   <input type="email" name="email" value="<?php echo $company->getEmail()?>" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Teléfono</label></b>
                                   <input type="number" name="phoneNumber" value="<?php echo $company->getPhoneNumber()?>" class="form-control" required>
                              </div>
                         </div>
                    </div>
                             
                         <div class="form-group">
                              <b><label for="">Descripción</label></b>
                              <textarea class="form-control" name="description"  class="form-control" rows="10" required><?php echo $company->getDescription()?></textarea>
                         </div>
                         <div cass="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Logo</label></b>
                                   <input class="form-control-file" type="file" name="logo" accept="image/png, .jpeg, .jpg, image/gif">
                                   <span>Archivo cargado: <?php echo $company->getLogo();?></span>
                              </div>
                         </div>
                    <button type="submit" name="button" value="" class="btn btn-dark ml-auto d-block">Guardar Cambios</button>

               </form>
          </div>
     </section>
</main>