<?php

session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>


<?php require '../header/navbar.php'; ?>


<?php require '../header/menu.php'; ?>



<div class='container'>
  <div class='row'>
    <div class='col-md-12 '>
      <div class='row'>
        <div class='col-md-10 offset-md-2  form' id="box_factura">

          <div class='card '>
            <div class='card-header bg-secondary mb-0'>
              <div class='form-group'>
                <h4>Facturas</h4>
              </div>


              <div class='form-group  '>
                <div class='card-tools float-right'>
                  <div class='input-group input-group-sm' style='width: 200px;height:30px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search' id='buscador'>
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            


            <div class='card-body ' style='height:350px;' >

              <div class='row' >
                <div class='col-md-8'></div>

                <div class='table-bordered table-responsive p-0' style='height: 300px;'>
                  <table class='table  table-head-fixed  ' >
                    <thead   >
                      <tr style='background:#adb5bd'>
                        <th >Nro.Fac</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id='tabla_factura'>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>







<script src="../js/venta.js"></script>

<?php require  '../header/footer.php';
require  '../header/script.php'; ?>

