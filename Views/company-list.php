<?php
    require_once('nav.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container ">
              
               <h2 class="mb-4">Listado de Empresas</h2>

               <?php if(($response!="")){?>
                    <p class="alert alert-sucess"><?php echo $response ?><p>
               <?php } ?>

               <form class="form-inline" action="<?php echo FRONT_ROOT ?>Company/CompanyListByName" methos="get">
                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search" name="name">
                    <button class="btn my-2" type="submit" >Buscar</button>
               </form>
              
               <table class="table bg-light-alpha border border-secondary">
                    <thead>
                         <th class="border border-secondary border-right-0 border-left-0">Logo</>
                         <th class="border border-secondary border-right-0 border-left-0">Nombre</th>
                         <th class="border border-secondary border-right-0 border-left-0">Cuit</th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                         <th class="border border-secondary border-right-0 border-left-0"></th>
                    </thead>
                    <tbody>
                       <form action= "<?php echo FRONT_ROOT ?>Company/ShowDetailView" method="POST">
                         <?php
                              foreach($companyList as $company)
                              {
                                   ?>
                                        <tr>
                                             <td class="logo"><img src="<?php echo IMAGE_PATH.$company->getLogo();?>"></td>
                                             <td><?php echo $company->getName() ?></td>
                                             <td><?php echo $company->getCuit() ?></td>                           
                                             <td> 
                                                  <button type="submit" name="button" class="btn btn-secondary" value="<?php echo $company->getCuit().",ver"; ?>"> Ver </button> 
                                             </td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </form>
                    </tbody>
               </table>
          </div>
     </section>
</main>