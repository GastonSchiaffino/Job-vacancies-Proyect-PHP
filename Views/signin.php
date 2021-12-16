<main class="d-flex align-items-center justify-content-center height-100">
          <div class="content">
               <header class="text-center">
                    <h2>Registro</h2>
               </header>



               <form action="<?php echo FRONT_ROOT . "User/AddStudentUser"?>" method="post" class="login-form bg-dark-alpha p-5 text-white">
                    <div class="form-group">
                         <label for="">Correo Electrónico</label>
                         <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
                         <?php
                                   if(isset($_POST['validationEmail'])){
                                      echo "<span class="."text-danger".">".$_POST['validationEmail']."</span>";
                                  }  
                         ?>    

                    </div>
                    <div class="form-group">
                         <label for="">Contraseña</label>
                         <input type="password" name="pass" class="form-control form-control-lg" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                         <label for="">Confirmar Contraseña</label>

                         <input type="password" name="checkedPass" class="form-control form-control-lg" placeholder="Contraseña" required>
                         <?php
                                   if(isset($_POST['validationPass'])){
                                       echo "<span class="."text-danger".">".$_POST['validationPass']."</span>";
                                  }             
                         ?>   
                         
                    </div>
                   
                    <button class="btn btn-dark btn-block btn-lg" type="submit">Crear Usuario</button>
               </form>

   
          </div>
     </main>

