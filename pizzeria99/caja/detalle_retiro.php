<?php
session_start();

if (!isset($_SESSION['username'])) {
 header("location: ../index.php");
}


require '../header/header.php';?>


<?php require '../header/menu.php'; ?>

<?php require '../header/navbar.php'; ?>




<div class='content-wrapper' >

<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 offset-lg-1  offset-md-1 offset-sm-1 offset-xs-1 " >

  <div class='row'>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  " id="tabla_cliente">

					<!-- general form elements disabled -->
					<div class='card '>
						<div class='card-header bg-danger mb-0' style="text-align: center;">
							
							<h3>Retiro o Ingreso de Dinero</h3>
						</div>

						<!-- /.card-header -->
						<div class='card-body'>

							<hr class='bg-success' style='height:3px'>
							<form id="form_retiro" method="post">
								

							<div class='row'>
								<div class='col-sm-6'>
									<div class='form-group'>
										<label>Empleado</label>
										<select name='cliente' class='form-control'  required='' id='id_persona' >
											<option value='0'id='op'>Elija una Opcion</option>
										</select>
									</div>
								</div>

								<div class='col-sm-6'>
									<!-- textarea -->
									<div class='form-group'>
										<label>Monto</label>
										<input type='number' name="cantidad" class='form-control'rows='3' placeholder='Enter ...' id='cantidad' value="">
									</div>
								</div>

								<div class='col-sm-6'>
									<div class='form-group'>
										<label>Descripcion</label>
										<input name="descripcion" id="descripcion" type="text" class='form-control  '>
									</div>
								</div>

								<div class='col-sm-6'>
									<div class='form-group'>
										<label>Tipo factura</label>
										<select name='tipo_factura' class='form-control' id='tipo_factura' >
											<option value='0'>Elija una Opcion</option>
											<option value="R">Retiro</option>
											<option value="I">Ingreso</option>
										</select>
									</div>
								</div>
							</div>
							<hr class='bg-Gray' style='height:3px'>
							
							<input class='btn btn-block btn-outline-danger' type="submit" value="Aceptar">
							
							
							<input name='id_admin' type='hidden' value="<?php echo $_SESSION['id_admin'] ?>" id='id_admin'>

							</form>

			</div>



		
</div>
</div>
</div>
</div>
</div>
</div>

<script src="agregar_datos.js"></script>

<input type="hidden" value="caja" id="flag">

<?php require  '../header/footer.php';
require  '../header/script.php'; ?>

