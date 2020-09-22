$(document).ready(function () {
	compraventa = ($("#compraventa").val() == 'ventas' ? 'ventasfecha' : 'comprasfecha');


	if (compraventa != " ") {
		$("#reportes").addClass("menu-open");

	}
	var n = new Date();
	var y = n.getFullYear();
	var m = n.getMonth() + 1;
	var d = n.getDate();
	let fecha = y + "/" + m + "/" + d;



	load();

	$('#reset').on('click', function () {
		location.reload();
	});
});

function load() {
	let fila = '';

	let date1 = $('#date1').val();

	$.ajax({
		url: 'lista_cumple.php',
		type: 'POST',
		data: {
			date1: date1
		},
		success: function (response) {
			let data = JSON.parse(response);

			data.forEach(data => {


				fila += `
							<tr facturaid="${data.id_persona}">
							<th>${data.fecha}</th>
							<th>${data.nombre}</th>
							<th>${data.apellido}</th>
							<th>${data.descripcion}</th>
							<th>${data.telefono}</th>
							<th>${data.email}</th>
							

							</tr>`
			});

			$("#datos_tabla").html(fila);

		}
	});




}
