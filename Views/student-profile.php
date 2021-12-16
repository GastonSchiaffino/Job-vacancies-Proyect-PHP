<?php

   require_once('nav.php');
   
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container border border-secondary rounded">
               <h2 class="mb-4">Mis Datos</h2>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Legajo</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getStudentId() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getLastName() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getFirstName() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">DNI</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getDni() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getEmail() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Género</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getGender() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getBirthDate() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Teléfono</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getPhoneNumber() ?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Carrera</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $careerController->CareerById($student->getCareerId(),$arrayCareer)->getDescription();?>">
                      </div>
               </div>
               <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label">Número de carpeta</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" readonly value="<?php echo $student->getFileNumber() ?>">
                      </div>
               </div>
     </section>
</main>