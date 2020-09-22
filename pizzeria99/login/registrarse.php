
<?php  require '../header/header.php';?>
</head>


<div class="register-box" id="registrarse">
	<div class="card">
		<div class="card-body register-card-body">
			<p class="login-box-msg">Registrarse</p>
			<form  method="post" id="form_registrar">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Nombre" required="" id="nombre">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>


				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Apellido" required="" id="apellido">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Nombre de usuario" required="" id="usuario">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>

				<div class="input-group mb-3">
					<input type="email" class="form-control" placeholder="Email" required="" id="email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" placeholder="Contraseña" required="" id="clave">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>

				
				
				<div class="input-group mb-3">
					<input type="date" class="form-control" placeholder="Fecha nacimiento" id="fecha" required="">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fa fa-calendar"></span>
						</div>
					</div>
				</div>


				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Direccion" required="" id="direccion">
					<div class="input-group-append">
						<div class="input-group-text">

							
						</div>
					</div>
				</div>

				<div class="input-group mb-3">
					<input type="tel" class="form-control" placeholder="Telefono" required="" id="telefono">
					<div class="input-group-append">
						<div class="input-group-text">

						</div>
					</div>
				</div>

				<div class="social-auth-links text-center">
					<button  class="btn btn-block btn-primary">Registrarse</button>
					

				</form>


			</div>

			<a href="../index.php" class="text-center" >Iniciar Sesion</a>
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->
</div>

<!-- /.register-box -->
<script src="../js/login.js"></script>
<?php 
require  '../header/script.php'; ?>