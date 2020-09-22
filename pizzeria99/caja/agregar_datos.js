$(document).ready(function () {
	lista_cliente();

	if ($("#flag").val() == "caja") {
		$("#caja").addClass("menu-open");

	}

	$('#form_retiro').submit(function (e) {

		e.preventDefault();

		const Datos = {
			id_empleado: $('#id_persona').val(),
			id_admin: $('#id_admin').val(),
			cantidad: $('#cantidad').val(),
			descripcion: $('#descripcion').val(),
			tipo_factura: $('#tipo_factura').val()
		};

		if (Datos.cantidad >0 && isNaN(Datos.descripcion) ) {
			//RESETEAR DATOS DEL FORMULARIO
			$.post('registrar_retiro.php', Datos, function (response) {

				$('#form_retiro').trigger('reset');
			});
		} else {
			toastr.warning('Datos invalidos', 'Advertencia');

		}


	});

});


function lista_cliente() {
	$.ajax({
		url: 'lista_cliente.php',
		type: 'POST',
		success: function (response) {
			$("#id_persona").html(response);
		}
	});
}