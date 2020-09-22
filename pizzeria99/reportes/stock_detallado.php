<?php
session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>


<?php require '../header/menu.php'; ?>

<?php require '../header/navbar.php'; ?>


<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-header with-border">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h2>Inventario de productos</h2>
                        </div>

                    </div>
                    
                    <div class="panel-body table-responsive">

                        <table id="example" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-blue">
                                <th>Id</th>
                                <th>Articulo</th>
                                <th>Categoria</th>
                                <th>Medida</th>
                                <th>Precio</th>
                                <th>Fecha Compra</th>
                                <th>Unidades</th>
                                <th>Proveedor</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Stock</th>

                            </thead>
                            <tbody>
                            </tbody>

                        </table>

                        <div />
                        <!--fin centro-->

                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>



<script src="../js/reportes.js"></script>
<?php require  '../header/footer.php';
require  '../header/script.php'; ?>