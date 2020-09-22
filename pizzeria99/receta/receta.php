<?php

session_start();

if (!isset($_SESSION['username'])) {
  header("location: ../index.php");
}

require '../header/header.php'; ?>


<?php require '../header/navbar.php'; ?>


<?php require '../header/menu.php'; ?>

<input value="1" type="hidden" id="capturar">

<div class='content-wrapper'>

    <form id="enviar_datos">
        <div class='row'>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

                <div class='row'>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-lg-1 offset-md-1" id="tabla_cliente">
                        <div class="card">


                            <div class='card-header bg-danger mb-0'>

                                <div class="row">

                                    <div class="col-sm-10">
                                        <div class='form-group'>
                                            <label>Receta</label>
                                            <select class='form-control  ' required='' id='lista_producto'>
                                                <option value='0'>Opciones</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 float-left button  " style="margin-top:7px;">
                                        <label for=""></label>

                                        <button class="btn btn-success btn-sm " data-toggle="modal"
                                            data-target="#add_receta" style="width: 150px;height:30px;" id="btn_moda">
                                            <i class="fa fa-plus-circle"></i>
                                            Insumos</button>

                                    </div>
                                </div>
                            </div>




                            <!-- /.card-header -->
                            <div class="card-body" style="height: 400px;">
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="example1_length"><label></label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example" class="table table-bordered table-striped dataTable"
                                                role="grid" aria-describedby="example1_info" style="height: 150px;">
                                                <thead class="bg-secondary">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Nombre</th>
                                                        <th>Cantidad</th>
                                                        <th>Medida</th>
                                                        <th class="text-right">Acciones</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                </tbody>
                                            </table>
                                            <!-- /.card-body -->
                                        </div>

                                    </div>
                                    <div class='row'>
                                        <div class='col-md-6 offset-md-3' style='margin-top: 15px;'>
                                            <button class='btn btn-outline-info btn-block' id='guardar_receta'>
                                                <i class='fa fa-save'></i>
                                                Guardar</button>
                                        </div>
                                    </div>
    </form>
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




<!--ventana agregar articulo-->
<section class="content">

    <div class="modal fade" id="editar_insumo" aria-hidden="true" style="display: none;">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gray">
                    <h4 class="modal-title" id="titulo_modal">Editar insumo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form role='form' id='form_insumo_edit'>
                        <div class='row'>

                            <div class='col-sm-4'>
                                <div class='form-group outline'>
                                    <label>Insumo</label>
                                    <select name='insumo_edit' class='form-control' required='' id='insumo_edit'>
                                    </select>
                                </div>
                            </div>

                            <div class='col-sm-4'>
                                <div class='form-group'>
                                    <label>Cantidad</label>
                                    <input type='number' class='form-control' rows='3' placeholder='Enter ...'
                                        required='' id='cantidad_edit'>
                                </div>
                            </div>


                            <div class='col-sm-4'>
                                <div class='form-group outline'>
                                    <label>Meidida</label>
                                    <select name='medida_edit' class='form-control' required='' id='medida_edit'>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div>
                            <div></div>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-danger" type="button" id="cancel"><i
                                    class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            <button id="add" type="submit" class="btn btn-success "><span
                                    class="fa fa-save"></span>Guardar</button>
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
                <div class="modal-header bg-gray">
                    <h4 class="modal-title" id="titulo_modal">Agregar insumo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class='form-group  '>
                        <div class='card-tools float-right'>
                            <div class='input-group input-group-sm' style='width: 200px;height:30px;'>
                                <input type='text' name='table_search' class='form-control float-right'
                                    placeholder='Search' id='buscador'>
                                <div class='input-group-append'>
                                    <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class='table-bordered table-sm table-responsive p-0 table-hover  table-head-fixed'
                        style='height: 300px;'>

                        <table class="table  text-nowrap">

                            <thead class="bg-primary">
                                <tr>
                                    <th>Agregar</th>
                                    <th>Nombre</th>
                                    <th>Medida</th>
                                    <th>Cantidad</th>

                                </tr>
                            </thead>
                            <tbody id="tabla">

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


<script src="../js/receta.js"></script>


<?php require  '../header/footer.php';
require  '../header/script.php'; ?>