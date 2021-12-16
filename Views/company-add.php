<?php

    require_once('nav.php');
    use Controllers\CompanyController as CompanyController;

    $companyController= new CompanyController();

  
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Agregar Compañía</h2>
               
               
               <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" enctype="multipart/form-data" class="bg-light-alpha p-5">
                    
                    <div class="row"> 
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Cuit</label></b>
                                   <input type="number" name="cuit" value="" class="form-control" required>
                                   
                                   <?php if(($response!="")&&(str_contains($response,"Cuit"))){?>
                                         <p class="alert alert-danger"><?php echo $response ?><p>
                                   <?php } ?>  

                              </div>
                         </div>                        
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Nombre</label></b>
                                   <input type="text" name="name" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Año de Fundación</label></b>
                                   <input type="number" name="yearFundation" value="" class="form-control" required>

                                   <?php if(($response!="")&&(!str_contains($response,"Cuit"))){?>
                                         <p class="alert alert-danger"><?php echo $response ?><p>
                                   <?php } ?>   

                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Ciudad</label></b>
                                   <input type="text" name="city" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Correo Electrónico</label></b>
                                   <input type="email" name="email" value="" class="form-control" required>
                              </div>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Teléfono</label></b>
                                   <input type="number" name="phoneNumber" value="" class="form-control" required>
                              </div>
                         </div>
                    </div>
                             
                         <div class="form-group">
                              <b><label for="">Descripción</label><b>
                              <textarea class="form-control" name="description" value="" class="form-control" rows="3" required></textarea>
                         </div>
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <b><label for="">Logo</label></b>
                                   <input class="form-control-file" type="file" name="logo" accept="image/png, .jpeg, .jpg, image/gif">
                              </div>
                         </div>
                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
               </form>
          </div>
     </section>
</main>