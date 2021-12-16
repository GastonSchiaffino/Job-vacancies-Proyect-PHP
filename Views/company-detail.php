<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container ">
              
               <h1 class="mb-4"><?php echo $company->getName() ?></h1>
                   
               <table class="table bg-light-alpha border border-secondary">
                    <thead>
                         <th class="border border-secondary border-right-0 border-left-0">Logo</>
                         <th class="border border-secondary border-right-0 border-left-0">Cuit</th>
                         <th class="border border-secondary border-right-0 border-left-0">Año de Fundación</th>
                         <th class="border border-secondary border-right-0 border-left-0">Ciudad</th>
                         <th class="border border-secondary border-right-0 border-left-0">Email</th>
                         <th class="border border-secondary border-right-0 border-left-0">Teléfono</th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                    </thead>
                    <tbody>
                       <form action= "<?php echo FRONT_ROOT ?>Company/Action" method="POST">
                              <tr>
                                   <td class="logo"><img src="<?php echo IMAGE_PATH.$company->getLogo();?>"></td>
                                   <td><?php echo $company->getCuit() ?></td>
                                   <td><?php echo $company->getYearFundation() ?></td>
                                   <td><?php echo $company->getCity() ?></td>
                                   <td><?php echo $company->getEmail() ?></td>
                                   <td><?php echo $company->getPhoneNumber() ?></td>
                                   <?php if(isset($_SESSION['admin'])){?>
                                   <td> 
                                        <button type="submit" name="button" class="btn btn-success" value="<?php echo $company->getCuit().",modify"; ?>"> Modificar </button> 
                                   </td>
                                   <td> 
                                        <button type="submit" name="button" class="btn btn-danger" value="<?php echo $company->getCuit().",remove"; ?>"> Eliminar </button>
                                   </td>
                                   <?php } ?>
                              </tr>              
                         </form>
                         </tr>
                    </tbody>
               </table><br>
               <h2>Quien Somos</h2>
               <p><?php echo $company->getDescription() ?></p>
          </div>
     </section>
</main>