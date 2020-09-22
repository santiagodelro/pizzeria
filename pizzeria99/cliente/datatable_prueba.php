<?php
session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>
</head>

<?php require '../header/menu.php'; ?>

<?php require '../header/navbar.php'; ?>


<!--Ejemplo tabla con DataTables-->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Puesto</th>
              <th>Ciudad</th>
              <th>Edad</th>
              <th>Año de Ingreso</th>
              <th>Salario</th>
            </tr>
          </thead>
          <tbody id="tabla">
            
          </tbody>        
        </table>                  
      </div>
    </div>
  </div>  
</div>    


<script>

  $(document).ready(function() {    
    $('#example').DataTable({
    //para cambiar el lenguaje a español
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "No se encontraron resultados",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sSearch": "Buscar:",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast":"Último",
        "sNext":"Siguiente",
        "sPrevious": "Anterior"
      },
      "sProcessing":"Procesando...",
    }
  });     
  });
</script>
<script src="../js/cliente.js"></script>




<?php //require  '../header/footer.php';
require  '../header/script.php'; ?>
