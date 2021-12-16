<?php
//require_once('api-consume.php');

use Controllers\CareerController;


?>
<main class="d-flex align-items-center justify-content-center height-100">
          <div class="content">
               <header class="text-center">
                    <h2>Login</h2>
               </header>

          <div class="login-form bg-dark-alpha p-5 text-white">
               <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post" >
                    <div class="form-group">
                         <label for="">Nombre de Usuario</label>
                         <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario" >
                    </div>
                    <div class="form-group">
                         <label for="">Contraseña</label>
                         <input type="password" name="pass" class="form-control form-control-lg" placeholder="Contraseña" >
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg border border-light">Iniciar Sesión</button>
               </form>

               <form action="<?php echo FRONT_ROOT . "Home/Signin"?>" method="post">
                    <button type="submit" class="btn btn-dark btn-block btn-lg border border-light">Registrarme</button>
               </form>
               </div>
          </div>
     </main>