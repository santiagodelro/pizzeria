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
            <h3>Articulos</h3> 

          </div>

          
            <div class="form-group">

              <button class="btn btn-success  "  data-toggle="modal" data-target="#nuevo_articulo"   id="btn_add">
                <i class="fa fa-plus-circle" ></i>
              Nuevo articulo</button>
           

              <button class="btn bg-info  "  data-toggle="modal" data-target="#nuevo_producto"   id="btn_add_prod">
                <i class="fa fa-plus-circle"  ></i>
              Crear producto</button>
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
            <th>Precio</th>
            <th>Categoria</th>
            <th>Medida</th>               
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








<input type='hidden' value='producto' id='on'>





<!--ventana agregar articulo-->
<section class="content"  >

  <div class="modal fade"  id="nuevo_articulo" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gray">
          <h4 class="modal-title" id="titulo_modal">Agregar articulo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <form role='form' id='form_articulo'>
            <div class='row'>

              <div class='col-sm-6'>
                <!-- text input -->
                <div class='form-group'>
                  <label>Nombre </label>
                  <input type='text'  class='form-control' placeholder='Enter ...' required='' id='nombre'>
                </div>
              </div>


              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Precio</label>
                  <input type='number' class='form-control'rows='3' placeholder='Enter ...'required='' id='precio'>
                </div>
              </div>

              <div class='col-sm-6' id="select_cat">
                <div class='form-group outline'>
                  <label>Categoria</label>
                  <select name='id_cat' class='form-control' required='' id='id_cat' >
                  </select>
                </div>
              </div>


              <div class='col-sm-6' id="select_medida" >
                <div class='form-group outline'>
                  <label>Meidida</label>
                  <select name='id_medida' class='form-control' required='' id='id_medida' >
                  </select>
                </div>
              </div>

            </div>
            <div >
              <div></div>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-danger"  type="button" id="cancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              <button id="agregar" type="submit" class="btn btn-success "><span class="fa fa-save"></span>Guardar</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</section>

<input type="hidden" id="id_prod">






<!--ventana agregar producto-->
<section class="content"  >

  <div class="modal fade"  id="nuevo_producto" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gray">
          <h4 class="modal-title" >Crear producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <form role='form' id='form_prod'>
            <div class='row'>

              <div class='col-sm-6'>
                <!-- text input -->
                <div class='form-group'>
                  <label>Nombre </label>
                  <input type='text'  class='form-control' placeholder='Enter ...' required='' id='nombre_prod'>
                </div>
              </div>


              <div class='col-sm-6'>
                <div class='form-group'>
                  <label>Precio</label>
                  <input type='number' class='form-control'rows='3' placeholder='Enter ...'required='' id='precio_prod'>
                </div>
              </div>


              <div class='col-sm-12'  >
                <div class='form-group outline'>
                  <label>Meidida</label>
                  <select name='medida_prod' class='form-control' required='' id='medida_prod'>
                  </select>
                </div>
              </div>

            </div>
            <div >
              <div></div>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-danger"  type="button" id="cancelar_prod"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              <button id="agregar_prod" type="submit" class="btn btn-success "><span class="fa fa-save"></span>Guardar</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</div>
</section>













<input type='hidden' value="<?php echo $_SESSION['id_admin'] ?>" id='id_admin'>
<script src="../js/producto.js"></script>


<?php require  '../header/footer.php';
require  '../header/script.php'; ?>

