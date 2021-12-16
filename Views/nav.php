<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
     <span class="navbar-text">
          <strong class="text-light">Bolsa de Trabajo</strong>
     </span>
     <ul class="navbar-nav ml-auto">

          <?php if(isset($_SESSION['company'])||isset($_SESSION['admin'])){?>
               <li class="nav-item">
                    <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>JobOffers/ShowAddView">Agregar Oferta</a>
               </li> 
          <?php } ?>

          <?php if(isset($_SESSION['admin'])){?>
          
               <li class="nav-item">
                    <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Company/ShowAddView">Agregar Empresa</a>
               </li>     
               <li class="nav-item">
                    <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Company/ShowListView">Empresas</a>
               </li>  
               <li class="nav-item">
                    <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Student/ShowListView">Alumnos</a>
               </li> 
          <?php } ?>

          

          <?php if(isset($_SESSION['student'])){?>
               <li class="nav-item">
                 <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Student/ShowProfileView">Mis Datos</a>
               </li> 
               <li class="nav-item">
               <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Company/ShowListView">Empresas</a>
               </li>  
          <?php } ?>

          <li class="nav-item">
                    <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>JobOffers/ShowListView">Ofertas Laborales</a>
          </li> 
             
          <li class="nav-item">
               <a class="nav-link text-light " href="<?php echo FRONT_ROOT ?>Home/Logout">Cerrar Sesión</a>
          </li>                  
     </ul>
</nav>
<footer>
     
</footer>
          