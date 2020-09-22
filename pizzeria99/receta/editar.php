<?php

session_start();

if (!isset($_SESSION['username'])) {
  header("location: ../index.php");
}

require '../header/header.php'; ?>


<?php require '../header/navbar.php'; ?>


<?php require '../header/menu.php'; ?>

<script src="../js/editar_receta.js"></script>


<div class='container'>
  <div class='row'>
    <div class='col-md-12 '>
      <div class='row'>
        <div class='col-md-10 offset-md-2  form' id='box_receta'>

          <div class='card '>
            <div class='card-header bg-gray mb-0'>

              <div class='row'>

                <div class='col-sm-9'>
                  <div class='form-group'>
                    <label>Receta</label>
                    <select class='form-control prod ' required='' id='producto_elaborado' style='height:40px;'>
                      <option value='0'>Opciones</option>
                    </select>
                  </div>
                </div>


                <div class="form-group text-center" style="margin-top: 32px;">
                  <button class="btn btn-danger btn-sm " id="eliminar_receta" style="width:100px;height:30px;">
                    <i class="fa fa-trash"></i>
                    Eliminar </button>
                  <button class="btn btn-success btn-sm " data-toggle="modal" data-target="#add_receta" id="btn_add" style="width:110px;height:30px;">
                    <i class="fa fa-plus-circle"></i>
                    Insumos</button>
                </div>





              </div>
            </div>


            <div class='card-body ' style='height:400px;'>



              <div class='row'>

                
                  <div class="col-md-2 offset-md-10">
                    <div class='form-group  float-right'>

                      <div class='input-group input-group-sm float-right' style='width: 200px;height:30px;'>
                        <input type='text' name='table_search' class='form-control float-right' placeholder='Search' id='buscador'>
                        <div class='input-group-append'>
                          <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                        </div>
                      </div>

                    </div>
                  </div>

              




                <div class='col-md-8'></div>
                <div class='table-bordered table-responsive p-0 table-hover' style='height: 300px;'>
                  <table class='table '>
                    <thead class="bg-gray ">
                      <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Acciones</th>

                      </tr>
                    </thead>
                    <tbody id='tabla'>
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

<section class="content">

  <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Editar insumo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <input type="hidden" id="id_receta" value="">
          <form role="form" id="form">
            <div class='row'>

              <div class='col-sm-4'>
                <div class='form-group'>
                  <label>Insumo</label>
                  <select name='insumo_edit' class='form-control' required='' id='insumo_edit'>

                  </select>
                </div>
              </div>

              <div class='col-sm-4'>
                <div class='form-group'>
                  <label>Cantidad</label>
                  <input type="number" class='form-control' name='cantidad_edit' id='cantidad_edit' required=''>
                </div>
              </div>

              <div class='col-sm-4'>
                <div class='form-group'>
                  <label>Medida</label>
                  <select name='medida_edit' class='form-control' required='' id='medida_edit'>

                  </select>
                </div>
              </div>

            </div>

            <div class="form-group text-center">
              <button class="btn btn-danger" type="button" id="cancel"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
              <button id="add" type="submit" class="btn btn-success "><span class="fa fa-save"></span>Guardar</button>
            </div>
        </div>

        </form>
      </div>
    </div>
  </div>
</section>


<!--ventana agregar articulo-->
<section class="content">

  <div class="modal fade" id="nuevo_insumo" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-gray">
          <h4 class="modal-title" id="titulo_modal">Agregar insumo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <form role='form' id='form_insumo'>
            <div class='row'>

              <div class='col-md-4'>
                <div class='form-group'>
                  <label>Ingredientes</label>
                  <select class='form-control' required='' id='insumo'>
                    <option value='0'>Opciones</option>
                  </select>
                </div>
              </div>

              <div class='col-sm-4'>
                <div class='form-group'>
                  <label>Cantidad</label>
                  <input type='number' class='form-control' rows='3' placeholder='Enter ...' required='' id='cantidad'>
                </div>
              </div>


              <div class='col-sm-4'>
                <div class='form-group outline'>
                  <label>Meidida</label>
                  <select name='unidad_medida' class='form-control' required='' id='unidad_medida'>
                  </select>
                </div>
              </div>

            </div>
            <div>
              <div></div>
            </div>
            <div class="form-group text-center">
              <button class="btn btn-danger" type="button" id="cancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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





<!--ventana agregar articulo-->
<section class="content">

  <div class="modal fade" id="add_receta" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title" id="titulo_modal">Agregar insumo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">

          <div class='form-group  '>
            <div class='card-tools float-right'>
              <div class='input-group input-group-sm' style='width: 200px;height:30px;'>
                <input type='text' name='table_search' class='form-control float-right' placeholder='Search' id='search'>
                <div class='input-group-append'>
                  <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class='table-bordered table-responsive p-0 table-hover  table-head-fixed' style='height: 300px;'>

            <table class="table  table-sm text-nowrap">

              <thead class="bg-primary">
                <tr>
                  <th>Agregar</th>
                  <th>Nombre</th>
                  <th>Medida</th>
                  <th>Cantidad</th>

                </tr>
              </thead>
              <tbody id="tabla_insumo">

              </tbody>

            </table>

          </div>
        </div>


      </div>
    </div>
  </div>
  </div>
</section>


<input type="hidden" value="editar_receta" id="on">




<?php require  '../header/footer.php';
require  '../header/script.php'; ?>