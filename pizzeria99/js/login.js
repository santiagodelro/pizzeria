$(document).ready(function (e) {
	

	$("#form").submit(function (e) {
		e.preventDefault();

		let usuario=$("#usuario").val();
		let clave=$("#clave").val();

		if (clave.length>=8) {
			$.post('login/logica.php',{usuario,clave},function (response) {
				let res=JSON.parse(response);
				console.log(response);

				res.forEach(res=>{
					if (res.response=="fail"){
						toastr.error('Usuario y/o contraseña incorrecta');
					}
					else{
						window.location.href="inicio/inicio.php";
					}
				});

			});
		}else{
			toastr.error('La contraseña debe contener como minimo 8 caracteres');	
		}
	});




	$("#form_registrar").submit(function (e) {
		e.preventDefault();

		let nombre=$("#nombre").val();
		let apellido=$("#apellido").val();
		let usuario=$("#usuario").val();
		let email=$("#email").val();
		let clave=$("#clave").val();
		let fecha=$("#fecha").val();
		let direccion=$("#direccion").val();
		let telefono=$("#telefono").val();

		if (clave.length>=8) {

			$.post('validacion_datos.php',{usuario,email},function (response) {
				let res=JSON.parse(response);
				console.log(response);

				res.forEach(res=>{
					if (res.response=="ok"){
						toastr.success('Registrado correctamente');
						$.post('agregar.php',{nombre,apellido,usuario,email,clave,fecha,direccion,telefono},function (response) {
							console.log(response);
						});

					}
					else if (res.response=="userexist") {
						toastr.error('Nombre de usuario no disponible');

					}
					else if (res.response=="emailexist") {
						toastr.error('Ya existe un usuario registrado con este email');

					}
					else if (res.response=="registrado") {
						toastr.error('Existe una cuenta registrada con estos datos');

					}
				});

			});
		}
		else{
			toastr.error('La contraseña debe contener como minimo 8 caracteres');
		}


	});




});


