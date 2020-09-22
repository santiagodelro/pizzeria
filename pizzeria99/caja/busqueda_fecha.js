$(document).ready(function () {

	//SALDO
	$.ajax({
		url: 'saldo.php',
		type: 'GET',
		dataType: 'html',
		success: function (data) {
			$("#inicial").html(data);
		}
	});


	if ($("#flag").val() == "caja") {
		$("#caja").addClass("menu-open");

	}
	
	$('#reset').on('click', function () {
		location.reload();
	});





});




function load() {
	let fila = '';
	let egreso = 0;
	let total_venta = 0;
	let total_ganancia = 0;

	let date1 = $('#date1').val();
	let date2 = $('#date2').val();
	

	$('#load_data').empty();
	loader = $('<tr ><td colspan = "4"><center>Cargando....</center></td></tr>');
	loader.appendTo('#load_data');
	setTimeout(function () {
		loader.remove();
		$.ajax({
			url: 'lista_caja.php',
			type: 'POST',
			data: {
				date1: date1,
				date2: date2
			},
			success: function (response) {
				let data = JSON.parse(response);

				data.forEach(data => {
					var ingreso = parseInt(data.precio) * parseInt(data.cantidad);
					var ganancia = ingreso - parseInt(data.costo) * parseInt(data.cantidad);
					egreso = parseInt(data.costo) + egreso;
					total_venta = ingreso + total_venta;
					total_ganancia = ganancia + total_ganancia;

					fila += `
							<tr facturaid="${data.id_detalle}">
							<th>${data.fecha}</th>
							<th>${data.nombre}</th>
							<th>${data.costo}</th>
							<th>${data.precio}</th>
							<th>${ingreso}</th>
							<th>${ganancia}</th>

							</tr>`
				});

				fila += `
							</br>
							<th>${""}</th>
							<th>${"Total Egreso:"}</th>
							<th>${egreso}</th>
							<th>${"Total ingreso:"}</th>
							<th>${total_venta}</th>
							<th>${"Total Ganancias: "}${total_ganancia}</th>
							`

				$("#datos_tabla").html(fila);

			}
		});
	}, 1000);



}
