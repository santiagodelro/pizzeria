<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link logo">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['username']) ?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



                <li class="nav-item has-treeview" id="producto">
                    <a href="#" class="nav-link">
                        <i class="fa fa-archive"></i>
                        <p>
                            Almacen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../producto/producto.php?accion=listado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Articulos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../categoria_articulo/categoria.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categoria</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview" id="compra">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cart-plus"></i>
                        <p>
                            Compras
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>





                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="../compra/compra.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compras</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../proveedor/proveedor.php?accion=listado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>



                    </ul>
                </li>



                <li class="nav-item has-treeview" id="venta">
                    <a href="#" class="nav-link">
                        <i class="fa fa-credit-card"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="../cliente/cliente.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cliente</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="../venta/venta.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ventas</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview" id="categoria">
                    <a href="#" class="nav-link">
                        <i class="fa fa-industry"></i>
                        <p>
                            categoria
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../categoria/categoria.php?accion=listado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Listado categoria</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../categoria/categoria.php?accion=registrar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nueva categoria</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item has-treeview" id="receta">
                    <a href="#" class="nav-link">
                        <i class="fa fa-align-justify"></i>
                        <p>
                            Receta
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../receta/receta.php?accion=agregar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nueva receta</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../receta/editar.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editar receta</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview" id="reportes">
                    <a href="#" class="nav-link">
                        <i class="fa fa-search"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="../reportes/stock_detallado.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../caja/detalle_cumple.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cumpleaños</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../reportes/comprasfecha.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../reportes/ventasfecha.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ventas</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item has-treeview" id="caja">
                    <a href="#" class="nav-link">
                    <i class="fa fa-link"></i>
                        <p>
                            Caja
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../caja/detalle_retiro.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retiro o Ingreso</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../caja/detalle_caja.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Busqueda por Fechas</p>
                            </a>
                        </li>
                    </ul>

                </li>

            </ul>

        </nav>
    </div>
</aside>