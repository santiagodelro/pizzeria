$(document).ready(function (e) {

	lista_factura();
	lista_cliente();
	LimpiarCampos();
	var n = new Date();
	var y = n.getFullYear();
	var m = n.getMonth() + 1;
	var d = n.getDate();
	let hora = d + "/" + m + "/" + y;
	$("#fecha").val(hora);
	var pepe = 0;
	lista_medida(0);
	numero_factura();
	Totales();
	RefrescarCarrito();
	$('#clientes').select2({
		theme: 'bootstrap4'
	});
	
	$('#medida').select2({
		theme: 'bootstrap4'
	});
	var insertar_fila = [];
	var editar_fila = [];
	var editar = false;

	if ($("#on").val() == "cliente") {
		$("#compra").addClass("menu-open");

	}

	$("#cantidad").keyup(function () {
		if ($("#cantidad").val()) {
			let medida = $("#medida_mostrar").val();
			console.log("morro");
			Calcular_Cantidad(medida);

		}
	});
	var data = $('#tabla_modal').DataTable({
		"ajax": {
			"url": "lista_producto.php",
			"type": "POST"
		},
		"searching": true,
		"responsive": true,
		"lengthChange": true,
		"pageLength":5,
		"autoWidth": true,
		"info":false,
		"columns": [
			{ "defaultContent": "<button data-dismiss='modal' class='btn bg-orange btn-sm float-left '  id='agregar'  ><i class='fa fa-plus-circle text-white'></i></button>" },
			{ "data": "id_prod" },
			{ "data": "nombre" },
			{ "data": "precio" },
			{ "data": "medida" },
		],

		"oLanguage": {
			"sProcessing": "Procesando...",
			"sLengthMenu": 'Mostrar <select>' +
				'<option value="10">10</option>' +
				'<option value="20">20</option>' +
				'<option value="30">30</option>' +
				'<option value="40">40</option>' +
				'<option value="50">50</option>' +
				'<option value="-1">All</option>' +
				'</select> registros',
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Por favor espere - cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});


	$(document).on('click', '#agregar', function () {
		LimpiarCampos();
		existencia = false;
		let elemento = $(this).closest("tr");
		let id = elemento.find("td:eq(1)").text();
		let insumo = elemento.find("td:eq(2)").text();
		let medida = elemento.find("td:eq(4)").text();
		let precio = elemento.find("td:eq(3)").text();
		let categoria = elemento.find("td:eq(5)").text();
		$('#btn_add').val(insumo);
		$('#precio').val(precio);
		$("#id_articulo").val(id);
		$("#medidacompra").val(medida);
		//console.log(id+insumo+medida+precio);
		Calculos(medida);
		insertar_fila = [
			id,
			insumo,
			0,
			medida,
		];
	});

	var tabla = $('#tabla_carro').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"scrollY": "126px",
		"scrollCollapse": true,
		"ordering": true,
		"info": false,
		"autoWidth": true,
		"responsive": true,
		"ajax": {
			"url": "lista_carrito.php",
			"type": "POST",
		},
		"columns": [
			{ "data": "id_prod" },
			{ "data": "nombre_producto" },
			{ "data": "precio" },
			{ "data": "nombre_medida" },
			{ "data": "cantidad" },
			{ "defaultContent": "<button class='btn bg-orange btn-sm float-left '  id='editar'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-center' id='eliminar_carrito'><i class='fa fa-trash'></i></button>" },

		],
		"oLanguage": {
			"sProcessing": "Procesando...",
			"sLengthMenu": 'Mostrar <select>' +
				'<option value="10">10</option>' +
				'<option value="20">20</option>' +
				'<option value="30">30</option>' +
				'<option value="40">40</option>' +
				'<option value="50">50</option>' +
				'<option value="-1">All</option>' +
				'</select> registros',
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Por favor espere - cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}


	});

	$("#form_compra").submit(function (e) {
		e.preventDefault();
		let producto = $("#id_articulo").val();
		let cantidad = $("#cantidad").val();
		let medida = $("#medida").val();
		let medidacompra = $("#medidacompra").val();
		let precio = $("#precio").val();
		let impuesto = $("#impuesto").val();
		let id_temp = $("#id_temp").val();
		let total = $("#total").val();
		let articulo_editar = $("#articulo_editar").val();
		let fecha = y + "-" + m + "-" + d;
		fecha = fecha.toString();
		let url = (editar ? 'actualizar_carrito.php' : 'agregar_carrito.php');
		Validar_existencia(producto);
		if (impuesto>0  &&  precio>0 && cantidad>0) {
		if (editar == false && producto != existencia || editar == true && producto == articulo_editar || producto != existencia) {
			console.log(medida);
			$.post(url, { id_temp, producto, precio, cantidad, total, fecha, medida, impuesto,medidacompra }, function (response) {
				console.log(response);
				tabla.ajax.reload(null, false);
				Totales();

				let res = JSON.parse(response);

					res.forEach(res => {
						if (res.respuesta=='nostock') {
							toastr.warning("Stock insuficiente!");
							
						}
					});
			
			});
		}
		else {
			toastr.warning("Este articulo ya fue agregado al carrito!");
		}

		//LimpiarCampos();
		$("#insertar").html('Agregar');
		editar = false;
	} else {
		toastr.warning("Datos invalidos!");
		
	}

	});

	$("#cancelar").click(function () {
		LimpiarCampos();
		$("#insertar").html('Agregar');
		editar = false;
	});


	//_eliminar del carrito___________________________________________________________
	$(document).on("click", "#eliminar_carrito", function () {
		if (confirm('Estas seguro?')) {
			let fila = $(this);
			let elemento = $(this).closest("tr");
			let id = parseInt(elemento.find("td:eq(0)").text());
			$.post('eliminar_carrito.php', { id }, function (response) {
				let res = JSON.parse(response);
				console.log(response);
				res.forEach(res => {
					if (res.respuesta == "ok") {
						tabla.row(fila.parents("tr")).remove().draw();
						toastr.success('Eliminado Correctamente');
					}
					else if (res.respuesta == "fail") {
						toastr.error('fallo al intentar eliminar ', 'Hubo un error');
					}
				});
				Totales();

			})
		}

	});


	$("#confirmar_compra").submit(function (e) {
		e.preventDefault();
		let proveedor = $("#clientes").val();
		let numero_factura = $("#num_fact").val();
		let tipo_fac = $("#tipo_factura").val();
		let iva = $("#iva").val();
		let fecha = y + "/" + m + "/" + d;
		fecha = fecha.toString();
		let id_admin = $("#id_admin").val();
		console.log(proveedor);
		console.log(numero_factura);
		console.log(tipo_fac);
		console.log(iva);
		console.log(fecha);
		console.log(id_admin);
		$.post('registrar_venta.php', { proveedor, numero_factura, tipo_fac, iva, fecha, id_admin }, function (response) {
			console.log(response);
			window.open('../venta/tcpdf/pdf/factura.php?numFac=' + numero_factura, "Factura", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=800 ,left=220");

		});



	});




	$(document).on('click', '#editar', function () {
		$("#insertar").html('Actualizar');

		editar = true;
		let elemento = $(this).closest("tr");
		let id = parseInt(elemento.find("td:eq(0)").text());
		console.log(id);
		$.post('obtener_datos.php', { id }, function (response) {
			const datos = JSON.parse(response);
			$('#btn_add').val(datos.nombre_producto);
			$("#id_articulo").val(datos.id_prod);
			$("#articulo_editar").val(datos.id_prod);
			$("#cantidad").val(datos.cantidad);
			$("#precio").val(datos.precio);
			$("#impuesto").val(datos.impuesto);
			$("#id_temp").val(datos.id_temp);
			lista_medida(datos.id_medida);
		});
	});

});




function editar_medida(medida) {
	$.ajax({
		url: 'editar_medida.php',
		type: 'POST',
		data: { medida },
		success: function (response) {
			$("#medida").html(response);
		}
	});
}



function Calcular_medida(medida) {
	$.ajax({
		url: 'calcular_medida.php',
		type: 'POST',
		data: { medida },
		success: function (response) {
			$("#medida").html(response);
		}
	});
}

function proveedor(idp) {
	$.ajax({
		url: 'lista_proveedor.php',
		type: 'POST',
		data: { idp },
		success: function (response) {
			$("#prov").append(response);
		}
	});
}
var indice = [0];

function ObtenerIndice(id) {
	var c = -1;
	$("#table_car tbody tr").each(function () {
		c += 1;
		let row = $(this).closest("tr");
		let idinsumo = $(row).attr('insumoid');
		console.log(id);
		if (idinsumo == id) {
			indice[0] = c;
		}
	});
}

var existencia = 0;

function Validar_existencia(id) {
	$("#tabla_carro tbody tr ").each(function () {
		let elemento = $(this).find('td');
		let idinsumo = elemento.filter(":eq(0)").text();
		if (id == idinsumo) {
			console.log("existe:" + id);
			existencia = idinsumo;
		}
	});
}

function Calculos(value) {

	Calcular_medida(value);
		

}



function Totales() {
	$.ajax({
		url: 'totales.php',
		type: 'POST',
		success: function (response) {

			$("#total").val('0');
			$("#subtotal").val('0');
			$("#iva").val('0');

			let datos = JSON.parse(response);
			datos.forEach(e => {
				let total = e.total;
				let subtotal = e.total;
				let totaliva = e.totaliva;
				$("#iva").val(totaliva);
				$("#total").val(total + totaliva);
				$("#subtotal").val(subtotal);

			});

		}




	});
}






function Calcular_Cantidad(value) {
	var operacion = '';
	var cantidad = $("#cantidad").val();

	switch (value) {
		case 'Mililitro':
			operacion = cantidad / 1000;
			break;
		case 'Litro':
			operacion = cantidad * 1000;
			break;
		case 'Kg':
			operacion = cantidad * 1000;
			break;
		case 'Gramos':
			operacion = cantidad / 1000;
			break;
	}
	let temp = new String(operacion);
	operacion = temp.replace(",", ".");
	$("#cantidadxmedida").val(operacion);

}


function lista_medida(id) {
	$.ajax({
		url: 'lista_medida.php',
		type: 'POST',
		data: { id },
		success: function (response) {
			$("#medida").html(response);
		}
	});
}




function LimpiarCampos() {
	$("#btn_add").val('');
	$("#precio").val('');
	$("#cantidad").val('');
	$("#impuesto").val('21');
	$("#subtotal").val('0');
	$("#iva").val('0');
	$("#total").val('0');
	lista_medida(0);

}

function numero_factura() {
	$.ajax({
		url: '../venta/numero_factura.php',
		type: 'POST',
		success: function (response) {
			let num_fac = parseFloat(response) + 1;
			$("#num_fact").val(num_fac);
		}
	});
}

//Buscador cliente_________________________________________________________________

$("#buscador").keyup(function (e) {

	if ($("#buscador").val()) {

		let buscador = $("#buscador").val();
		let fila = '';
		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: { buscador },
			success: function (response) {

				let data = JSON.parse(response);

				data.length == 0 ? fila += '<li>No se encontraron resultados</li> ' : 0;

				console.log(data);
				data.forEach(data => {

					fila += `
						<tr facturaid="${data.id_factura} numfac="${data.num_fac}">
						<th>${data.num_fac}</th>
						<th>${data.fecha}</th>
						<th>${data.nombre + ' ' + data.apellido}</th>
						<th>${data.total}</th>
						<th> 
						<button class="btn btn-outline-danger btn-sm " id="eliminar_factura" style="width:30px">
						<i class="fa fa-trash"></i>
						</button> 
						<button class="btn btn-outline-primary btn-sm " id="editar" data-toggle="modal" data-target="#modal-default" style="width:30px">
						<i class="fa fa-eye"></i>
						</button>
						</th>
						</tr>`

				});
				$("#tabla_factura").html(fila);
			}
		});
	}
	else {
		lista_factura();
	}
});

$(document).on('click', '#ver_factura', function () {
	let factura = $(this)[0].parentElement.parentElement;
	let id = $(factura).attr('facturaid');

	let num_fac = $(factura).attr('numfac');

	window.open('tcpdf/pdf/factura.php?numFac=' + num_fac, "Factura", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=800 ,left=220");
});



if ($("#on").val() == "venta") {
	$("#venta").addClass("menu-open");

}




function lista_cliente() {
	$.ajax({
		url: 'lista_cliente.php',
		type: 'POST',
		success: function (response) {
			$("#clientes").append(response);
		}
	});
}











function numero_factura() {
	$.ajax({
		url: 'numero_factura.php',
		type: 'POST',
		success: function (response) {
			let num_fac = parseFloat(response) + 1;
			$("#num_fact").val(num_fac);
		}
	});
}



//_eliminar factura___________________________________________________________
$(document).on("click", "#eliminar_factura", function () {

	if (confirm('Estas seguro?')) {

		let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('facturaid');
		console.log(elemento);
		var res = '';
		$.post('eliminar_factura.php', { id }, function (response) {
			lista_factura();
			let res = JSON.parse(response);
			console.log(response);
			res.forEach(res => {
				if (res.respuesta == "ok") {
					toastr.success('Eliminado Correctamente');
				}
				else if (res.respuesta == "fail") {
					toastr.error('fallo al intentar eliminar ', 'Hubo un error');
				}
			});
		});
	}

});





//_eliminar del carrito___________________________________________________________
$(document).on("click", "#eliminar", function () {

	if (confirm('Estas seguro?')) {

		let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('carritoid');
		console.log(elemento);

		var res = '';
		$.post('eliminar_carrito.php', { id }, function (response) {

			let res = JSON.parse(response);
			console.log(response);
			res.forEach(res => {
				if (res.respuesta == "ok") {
					toastr.success('Eliminado Correctamente');
					carrito();

				}
				else if (res.respuesta == "fail") {
					toastr.error('fallo al intentar eliminar ', 'Hubo un error');
				}
			});
		})


	}

});






//Lista de clientes________________________________________________________________



function lista_factura() {
	let fila = '';
	$.ajax({
		url: 'lista_factura.php',
		type: 'GET',
		success: function (response) {
			let data = JSON.parse(response);


			data.forEach(data => {
				fila += `
				<tr facturaid="${data.id_factura}" numfac="${data.num_fac}">
				<th>${data.num_fac}</th>
				<th>${data.fecha}</th>
				<th>${data.nombre + ' ' + data.apellido}</th>
				<th>${data.total}</th>
				<th> 
				<button class="btn btn-outline-danger btn-sm " id="eliminar_factura" style="width:30px">
				<i class="fa fa-trash"></i>
				</button> 
				<button class="btn btn-outline-primary btn-sm " id="ver_factura" data-toggle="modal" data-target="#modal-default" style="width:30px">
				<i class="fa fa-eye"></i>
				</button>
				</th>
				</tr>`
				$("#tabla_factura").html(fila);
			});
		}
	});

	if (fila == '') {
		$("#tabla_factura").html('');

	}
}


function RefrescarCarrito() {
	let temp='temp';
	$.ajax({
		url: 'eliminar_carrito.php',
		type: 'POST',
		data:{temp},
		success: function (response) {
			console.log(response);
		}
	});
}























