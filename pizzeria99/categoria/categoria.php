<?php 

session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}


require '../header/header.php';?>
</head>

<?php require '../header/menu.php'; ?>

<?php require '../header/navbar.php'; ?>


<?php if($_GET["accion"]=="listado"){?>

  <div class='content-wrapper' >

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

        <div class='row'>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " id="tabla_cliente">

           <div class="card">
            <div class="card-header bg-info">
              <h3>Categoria</h3> 
            </div>

            <!-- /.card-header -->
            <div class="card-body" >
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" >
                <thead class="bg-secondary">
                 <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th class="text-right">Acciones</th>
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>
            <!-- /.card-body -->
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


<input type='hidden' value='cliente' id='cat'>

<?php } ?>



<?php if($_GET["accion"]=="registrar"){?>

  <input type='hidden' value='cliente' id='cat'>
  <div class='container'>
    <div class='row'>
      <div class='col-md-7 offset-md-3 form' id='form_categoria'>
        <!-- general form elements disabled -->
        <div class='card '>
          <div class='card-header bg-gray mb-0'>
            <i class='fa fa-plus'class='text-right' style='width:auto;font-size:20px'> Nueva categoria
            </div></i>

            <!-- /.card-header -->
            <div class='card-body'>
              <form role='form' id='form'>
                <div class='row'>

                  <div class='col-sm-12'>
                    <!-- text input -->
                    <div class='form-group'>
                      <label>Nombre categoria </label>
                      <input type='text' class='form-control' placeholder='Enter ...' required='' id='nombre'>
                    </div>
                  </div>


                  <div class='col-md-6 offset-md-3'>
                    <button class='btn bg-info btn-block' id='guardar'>
                      <i class='fa fa-save' ></i>
                    Registrar</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php }?>


<section class="content">

  <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Actualizar Informacion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form role='form' id='form'>

            <input type="hidden" id="idcat">

            <div class='row'>

              <div class='col-sm-12'>
                <!-- text input -->
                <div class='form-group'>
                  <label>Nombre categoria </label>
                  <input type='text' class='form-control' placeholder='Enter ...' required='' id='nombre'>
                </div>
              </div>
            </div>

            <div class='col-md-6 offset-md-3'>
              <button class='btn btn-success btn-block' id='guardar'>Guardar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>



<script src="../js/categoria.js"></script>


<?php require  '../header/footer.php';
require  '../header/script.php'; ?>
