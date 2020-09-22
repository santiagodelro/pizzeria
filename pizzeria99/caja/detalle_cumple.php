<?php

session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>


<?php require '../header/navbar.php'; ?>


<?php require '../header/menu.php'; ?>



<div class='content-wrapper' >

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

  <div class='row'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " id="tabla_cliente">

          <div class='card '>
            <div class='card-header bg-secondary mb-0'>
              <div class='form-group'>
                <h3 style="text-align: center;">Busqueda de Cumpleaños en el mes</h3>
              </div>
              

              <div class='form-group  '>
                <div class="panel-body">
                  
                  
                   <div class = "form-inline">
                    <h3>Fecha : </h3>
                    <input type = "date" class = "form-control" value="<?php echo date("Y-m-d"); ?>"   id = "date1"/>
                    <button type = "button" class = "btn btn-default" id = " fa-search" onclick="load();">
                      <i class="fas fa-search"></i>
                    </button>
                  

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
                        <th >Fecha de Nacimiento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Producto</th>                   
                        <th>Telefono</th>    
                        <th>Email</th>    

                      </tr>
                    </thead>
                    <tbody id='datos_tabla'>
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

<input type="hidden" value="ventas" id="compraventa">





<script src = "busqueda_cumple.js"></script>
<?php require  '../header/footer.php';
require  '../header/script.php'; ?>