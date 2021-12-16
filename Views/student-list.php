<?php
    require_once('nav.php');
    
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container-fluid">
               <h2 class="mb-4">Listado de estudiantes</h2>
               <table class="table bg-light-alpha">
                    <thead>
                         <th>Legajo</th>
                         <th>Apellido</th>
                         <th>Nombre</th>
                         <th>DNI</th>
                         <th>Email</th>
                         <th>Genero</th>
                         <th>Fecha de cumpleaños</th>
                         <th>Telefono</th>
                         <th>Carrera</th>
                         <th>Numero de carpeta</th>
                    </thead>
                    <tbody>
                         <?php
                              foreach($studentList as $student)
                              {
                                   ?>
                                        <tr>
                                             <td><?php echo $student->getStudentId() ?></td>
                                             <td><?php echo $student->getLastName() ?></td>
                                             <td><?php echo $student->getFirstName() ?></td>
                                             <td><?php echo $student->getDni() ?></td>
                                             <td><?php echo $student->getEmail() ?></td>
                                             <td><?php echo $student->getGender() ?></td>
                                             <td><?php echo $student->getBirthDate() ?></td>
                                             <td><?php echo $student->getPhoneNumber() ?></td>
                                             <td><?php echo $careerController->CareerById($student->getCareerId(),$arrayCareer)->getDescription();?></td>
                                             <td><?php echo $student->getFileNumber() ?></td>
                                        </tr>
                                   <?php
                              }
                         ?>
                         </tr>
                    </tbody>
               </table>
          </div>
     </section>
</main>