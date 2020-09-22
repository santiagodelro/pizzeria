<?php 

session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}


require '../header/header.php';?>


<?php require '../header/menu.php'; ?>

<?php require '../header/navbar.php'; ?>




<div class='content-wrapper' >

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

  <div class='row'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " id="tabla_cliente">
         <div class="card">

          <div class="card-header bg-secondary">
            <div class="row">
              <div class="col-md-2">
                <h3>Categoria</h3> 

              </div>

              <div class="col-md-2 float-left">
                <button class="btn btn-success  text-left "  data-toggle="modal" data-target="#nueva_categoria"  style="width: 150px;" id="btn_modal">
                  <i class="fa fa-plus-circle"></i>
                Nueva</button>

              </div>
            </div>
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





<section class="content">

  <div class="modal fade" id="nueva_categoria" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center bg-danger">
          <h5 class="modal-title " id="titulo_modal">Agregar categoria</h5>
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
                  <label>Nombre categoria</label>
                  <input type='text' class='form-control' placeholder='Enter ...' required='' id='nombre'>
                </div>
              </div>
            </div>

            <div class='col-md-6 offset-md-3'>
              <button class='btn btn-success btn-block ' id='guardar'><span class="fa fa-save"></span> Guardar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>


<script src="../js/categoria_articulo.js"></script>


<?php require  '../header/footer.php';
require  '../header/script.php'; ?>
