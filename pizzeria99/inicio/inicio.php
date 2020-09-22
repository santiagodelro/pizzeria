<?php 

session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}

require '../header/header.php';?>
</head>

<?php require '../header/navbar.php'; ?>

<?php require '../header/menu.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Compra</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="../compra/compra.php?accion=registrar" class="small-box-footer">Ir<i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Venta</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="../venta/venta.php?accion=ventas" class="small-box-footer">Ir <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                 <!-- ./col -->
                 <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Articulos</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-tasks"></i>
                        </div>
                        <a href="../producto/producto.php" class="small-box-footer">Ir <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="../cliente/cliente.php?accion=listado" class="small-box-footer">Ir <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Proveedores</p>
                        </div>
                        <div class="icon">
                        <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="../proveedor/proveedor.php?accion=listado" class="small-box-footer">Ir <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-2 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Receta</p>
                        </div>
                        <div class="icon">
                        <i class="fas fa-mortar-pestle"></i>
                            
                        </div>
                        <a href="../receta/receta.php" class="small-box-footer">Ir <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->






            </div>
    </section>
</div>


<?php include '../header/footer.php'; ?>
<?php include '../header/script.php'; ?>