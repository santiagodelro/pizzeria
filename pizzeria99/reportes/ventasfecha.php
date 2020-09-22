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
                            <h2>Consulta de Ventas por Fecha</h2>
                        </div>

                    </div>
                    <!--box-header-->
                    <!--centro-->
                    <div class="row">
                        <div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio"
                                value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <div class="form-group col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                                value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                    <div class="panel-body table-responsive" id="listadoregistros">


                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="bg-blue">
                                <th>Nro.Factura</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>Total Compra</th>
                                <th>Impuesto</th>
                                <th>Acciones</th>
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

<input type="hidden" value="ventas" id="compraventa">


<script src="../js/reportes.js"></script>
<?php require  '../header/footer.php';
require  '../header/script.php'; ?>