<?php
session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>
</head>

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
                <h3>Cliente</h3> 

              </div>

              <div class="col-md-2 float-left">
                <button class="btn btn-success  text-left "  data-toggle="modal" data-target="#nuevo_cliente"  style="width: 150px;" id="btn_modal">
                  <i class="fa fa-plus-circle"></i>
                Nueva</button>

              </div>
            </div>
          </div>

          <!-- /.card-header -->
          <div class="card-body" >
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" >
              <thead class="bg-primary">
               <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Telefono</th>               
                <th>Fecha nac</th>
                <th>Acciones</th>
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

<input type='hidden' value='venta' id='on'>


<input type='hidden' value='cliente' id='on'> 

<section class="content">

  <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h4 class="modal-title">Actualizar Informacion</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form role='form' id='form_edit'>

            <input type="hidden" id="idpe_edit">

            <div class='row'>

              <div class='col-sm-6'>
                <!-- text input -->
                <div class='form-group'>
                  <label>Nombre </label>
                  <input type='text' class='form-control' placeholder='Enter ...' required='' id='nombre_edit'>
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Apellido</label>
                  <input type='text'class='form-control' placeholder='Enter ...' required='' id='apellido_edit'>
                </div>
              </div>
            </div>

            <div class='row'>
              <div class='col-sm-6'>
                <!-- textarea -->
                <div class='form-group'>
                  <label>Telefono</label>
                  <input type='number' class='form-control'rows='3' placeholder='Enter ...'required='' id='telefono_edit'>
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Fecha de nacimiento</label>
                  <input type='date' class='form-control'rows='3' placeholder='Enter ...'required='' id='fecha_edit'>
                </div>
              </div>

              <div class='col-sm-12'>
                <div class='form-group'>
                  <label>Domicilio</label>
                  <input type='text' class='form-control' rows='3' placeholder='Enter ...' required='' id='domicilio_edit'>
                </div>
              </div>

              <div class='col-sm-12'>
                <div class='form-group'>
                  <label>Email</label>
                  <input type='text' class='form-control' rows='3' placeholder='Enter ...' required='' id='email_edit'>
                </div>
              </div>

              
            </div>
            <div class='col-md-6 offset-md-3'>
              <button class='btn btn-success btn-block' id='actualizar'>Guardar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>






<section class="content">

  <div class="modal fade" id="nuevo_cliente" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Registrar cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form role='form' id='form'>
            <div class='row'>

              <div class='col-sm-6'>
                <!-- text input -->
                <div class='form-group'>
                  <label>Nombre </label>
                  <input type='text' class='form-control' placeholder='Enter ...' required='' id='nombre'>
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Apellido</label>
                  <input type='text'class='form-control' placeholder='Enter ...' required='' id='apellido'>
                </div>
              </div>
            </div>

            <div class='row'>
              <div class='col-sm-6'>
                <!-- textarea -->
                <div class='form-group'>
                  <label>Telefono</label>
                  <input type='number' class='form-control'rows='3' placeholder='Enter ...'required='' id='telefono'>
                </div>
              </div>

              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Fecha de nacimiento</label>
                  <input type='date' class='form-control'rows='3' placeholder='Enter ...'required='' id='fecha'>
                </div>
              </div>

              <div class='col-sm-12'>
                <div class='form-group'>
                  <label>Domicilio</label>
                  <input type='text' class='form-control' rows='3' placeholder='Enter ...' required='' id='domicilio'>
                </div>
              </div>

              <div class='col-sm-12'>
                <div class='form-group'>
                  <label>Email</label>
                  <input type='email' class='form-control' rows='3' placeholder='Enter ...' required='' id='email'>
                </div>
              </div>
              <div class='col-md-6 offset-md-3'>
                <button class='btn btn-info btn-block' id='guardar'>
                  <i class='fa fa-save' ></i>
                Registrar</button>
              </div>
            </div>
          </div>



        </div>

      </form>
    </div>
  </div>
</div>
</section>

<script src="../js/cliente.js"></script>


<?php require  '../header/footer.php';
require  '../header/script.php'; ?>
