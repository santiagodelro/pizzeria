<?php
session_start();

if ( !isset( $_SESSION['username'] ) ) {
    header( 'location: ../index.php' );
}

require '../header/header.php';
?>
</head>

<?php require '../header/menu.php';
?>

<?php require '../header/navbar.php';
?>

<!-- Formulario de compras -->

<div class='content-wrapper' id="container_compras">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class='row'>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  " ">

                    <!-- general form elements disabled -->
                    <div class='card ' style='height: 540px;'>
                        <div class='card-header bg-info mb-0'>

                            <h3>Venta</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class='card-body'>
                            <form role='form' id='form_compra' method='POST'>
                                <div class='row'>
                                    
                                    <input type='hidden' value='' id='id_articulo'>
                                    <input type='hidden' value='' id='articulo_editar'>

                                    <input type='hidden' value='' id='medidacompra'>
                                    <input type='hidden' value='' id='id_temp'>



                                    <div class='col-sm-8'>
                                        <label for='btn_add'>Articulo:</label>
                                        <div class='input-group mb-3'>

                                            <input type='text' disabled class='form-control' id='btn_add'>
                                            <div class='input-group-prepend'>
                                                <button type='button' class='btn btn-secondary' data-toggle='modal'
                                                    data-target='#add_articulo'>
                                                    <i class='fa fa-plus-circle'></i>
                                                </button>
                                            </div>
                                            <!-- /btn-group -->

                                        </div>
                                    </div>

                                    <div class='col-sm-4'>
                                        <!-- textarea -->
                                        <div class='form-group'>
                                            <label>Precio</label>
                                            <input type='number' id="precio"  class='form-control'
                                                rows='3' value=''>
                                        </div>
                                    </div>
                                  

                                </div>

                                <div class='row'>
                                <div class='col-sm-2'>
                                        <!-- textarea -->
                                        <div class='form-group'>
                                            <label>Cantidad</label>
                                            <input type='number' class='form-control' rows='3' placeholder='Enter ...'
                                                required='' id='cantidad' value=''>
                                        </div>
                                    </div>

                                    <div class='col-sm-3'>
                                        <div class='form-group'>
                                            <label>Medida</label>
                                            <select name='medida' class='form-control' required='' id='medida'>

                                            </select>
                                        </div>
                                    </div>
                                    <div class='col-sm-2'>
                                        <div class='form-group'>
                                            <label>Iva%</label>
                                            <input type='number' class='form-control' rows='3' id='impuesto' value='0'
                                                placeholder='Enter ...'>
                                        </div>
                                    </div>

                                    <div class='col-sm-4 ' style='margin-top: 30px;'>
                                        <div class='form-group '>
                                            <button type='button' class='btn btn-danger btn-md float-right'
                                                id="cancelar">Cancelar

                                            </button>
                                            <button type='submit' class='btn btn-primary btn-md float-right'
                                                style='margin-right: 5px;' id="insertar">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class='card' style='height:262px;'>
                            <div class='card-body'>
                                <ol class='breadcrumb bg-secondary align-middle  ' style='height: 40px;'>
                                    <li class='breadcrumb-item active text-white' style='font-size:18px'>Carrito de
                                        Venta
                                    </li>
                                </ol>

                                <table class='table table-sm table-bordered table-striped ' 
                                  id="tabla_carro">
                                    <thead class='bg-primary '>
                                        <tr>
                                        <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Costo</th>
                                            <th>Medida</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                  
                                    </tbody>

                                </table>

                            </div>
                        
                       
                        </div>

                    </div>

                </div>

                <div class='col-md-4 '>

                    <!-- general form elements disabled -->
                    <div class='card ' style='height:  540px;'>
                        <div class='card-header bg-info mb-0'>

                            <h3>Detalles</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class='card-body'>
                            <form role='form' id='confirmar_compra'>
                                <div class='row'>

                                    <div class='col-sm-12'>
                                        <div class='form-group'>
                                            <label>Cliente</label>
                                            <select name='clientes' class='form-control' required='' id='clientes'>
                                                <option value=''>Elija una Opcion</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <!-- text input -->
                                        <div class='form-group '>
                                            <label>Subtotal</label>
                                            <input type='text' class='form-control  ' disabled value='0.00'
                                                id='subtotal'>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label>Total Iva</label>
                                            <input type='text' class='form-control ' value='' id='iva' disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class='row'>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label>Fecha</label>
                                            <input type='text' class='form-control ' disabled id='fecha'>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <!-- textarea -->
                                        <div class='form-group'>
                                            <label>Nro de factura</label>
                                            <input type='text' class='form-control  ' disabled rows='3' id='num_fact'>
                                        </div>
                                    </div>

                                </div>

                                <div class='row'>

                                    <div class='col-sm-6'>
                                        <!-- textarea -->
                                        <div class='form-group'>
                                            <label>Total</label>
                                            <input type='text' class='form-control  ' disabled rows='3' id='total'>
                                        </div>
                                    </div>

                                    <div class='col-sm-6'>
                                        <div class='form-group'>
                                            <label>Tipo factura</label>
                                            <select name='tipo_factura' class='form-control' required=''
                                                id='tipo_factura'>
                                                <option value='' >Elija una Opcion</option>
                                                <option value='A'>A</option>
                                                <option value='B'>B</option>
                                                <option value='C'>C</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <hr class='bg-Gray' style='height:3px'>

                                <div class='col-md-12 position-sticky'>
                                    <button type="submit" class='btn btn-block btn-success' id='confirmar'>

                                        Confirmar
                                        <i class='fa fa-check'>
                                        </i>
                                    </button>

                                </div>
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

<!--ventana agregar articulo-->
<section class='content' id="contenedor">

    <div class='modal fade ' id='add_articulo' aria-hidden='true'>

        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header bg-danger'>
                    <h4 class='modal-title' id='titulo_modal'>Seleccione un Articulo</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>×</span>
                    </button>
                </div>

                <div class='modal-body' id="contenedor">

                    <table id="tabla_modal" class="table table-striped table-bordered display nowrap responsive"
                        cellspacing="0">

                        <thead width="100%" class="bg-primary">
                            <tr>
                                <th>Accion</th>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Medida</th>
                                

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
    </div>
</section>




<input type='hidden' value='venta' id='on'>
<input type='hidden' value="<?php echo $_SESSION['id_admin'] ?>" id='id_admin'>



<script src='../js/venta.js'></script>

<?php require  '../header/footer.php';
require  '../header/script.php';
?>