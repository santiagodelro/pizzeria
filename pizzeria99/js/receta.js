$(document).ready(function () {

	var array = [0];
	var rows = '';
	var tabla = '';
	var elemento = '';

	if ($("#on").val() == "receta" || $("#on").val() == "editar_receta") {
		$("#receta").addClass("menu-open");
	}


	lista(0);


	lista_producto();


	$('#insumo').select2({
		theme: 'bootstrap4'
	});

	$('#lista_producto').select2({

	});

	$('#medida').select2({
		theme: 'bootstrap4'
	});


	$('#insumo_edit').select2({
		theme: 'bootstrap4'
	});

	$('#medida_edit').select2({
		theme: 'bootstrap4'
	});




	$(document).on('click', '#agregar', function () {

		let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('insumoid');
		let cantidad = $("#cant" + id).val();
		let medida = $("#" + id).val();

		let button = "<button class='btn bg-orange btn-sm float-right '  id='editar' data-toggle='modal' data-target='#editar_insumo' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-right' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>";

		tabla = $('#example').DataTable();
		let fila = tabla.row($(this).parents('tr'));

		let e = $(this)[0].parentElement;

		var insumo = $(elemento).attr('name');

		console.log(id + medida + cantidad + insumo);


		if (medida == 0 || cantidad <= 0) {
			toastr.warning("Rellenar todos los campos!")
		}
		else if (medida == 0) {
			toastr.warning("Debes seleccioar una medida!")
		}
		else if (cantidad <= 0) {
			toastr.warning("Cantidad debe ser mayor a cero!")
		}

		else if (Validar_existencia(id, array)) {
			array.push(id);
			//agregar fila
			tabla.row.add([
				id,
				insumo,
				cantidad,
				medida,
				button,
			]).draw(false);
			$("#cant" + id).val('');
			$("#buscador" + id).val('');

			

		}
		else {
			toastr.warning("Ya has seleccionado este insumo!");

		}

	});






	$('#example').DataTable({
		"paging": false,
		"lengthChange": true,
		"searching": true,
		"scrollY": "150px",
		"scrollCollapse": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"responsive": true,
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



	$("#btn_moda").attr('disabled', true);


	$("#lista_producto").change(function () {
		let producto = $("#lista_producto").val();

		if (producto > 0) {
			array=[0];
			array.push(producto);
			$("#btn_moda").attr('disabled', false);
			
		}
		else {
			$("#btn_moda").attr('disabled', true);

		}

		//eliminarTodasFilas();
	});


	$("#enviar_datos").submit(function (e) {
		e.preventDefault();

		$("#guardar_receta").click(function (e) {
			e.preventDefault();

			if (!RecorrerTabla()) {
				toastr.success('Guardado Correctamente');

			}
			else {
				toastr.error('No se pudo gurdar ', 'Hubo un error');

			}
			eliminarTodasFilas();


		});



	});


	$("#example").on('click', '#editar', function () {
		rows = '';
		let id = '';
		let insumo = '';
		let cantidad = '';
		let medida = '';
		elemento = '';
		

		tabla = $('#example').DataTable();
		rows = tabla.row($(this).parents('tr'));

		elemento = $(this).closest("tr");

		id = elemento.find("td:eq(0)").text();
		insumo = elemento.find("td:eq(1)").text();
		cantidad = elemento.find("td:eq(2)").text();
		medida = elemento.find("td:eq(3)").text();

		console.log("lista:" + id + insumo + cantidad + medida)

		editar_insumo(array,id);
		editar_medida(medida);

		$("#cantidad_edit").val(cantidad);


	});


	$("#form_insumo_edit").submit(function (e) {
		e.preventDefault();

		let insumo = $("#insumo_edit").val();
		let nombreinsumo = $('#insumo_edit option:selected').html();
		let cantidad = $("#cantidad_edit").val();
		let medida = $("#medida_edit").val();

		console.log(nombreinsumo + " " + cantidad + " " + medida);

		let tabla = $('#example').DataTable();
		let fila = tabla.row($(this).parents('tr'));

		var button = "<button class='btn bg-orange btn-sm float-right '  id='editar' data-toggle='modal' data-target='#editar_insumo' style='width:40px'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm  float-right' id='eliminar' style='width:40px'><i class='fa fa-trash'></i></button>";

		let data = [
			insumo,
			nombreinsumo,
			cantidad,
			medida,
			button
		];

		array.push(insumo);
		

		tabla
			.row(rows)
			.data(data)
			.draw();

		$("#form_insumo_edit").trigger('reset');

	});



	//_eliminar___________________________________________________________
	$(document).on("click", "#eliminar", function () {
		var tabla = $('#example').DataTable();
		var fila = tabla.row($(this).parents('tr'));
		let elemento = $(this).closest("tr");
		let id = parseInt(elemento.find("td:eq(0)").text());
		Eliminar(id, array);
		tabla.row(fila).remove().draw();
		
		toastr.success('Eliminado Correctamente');
	});



	//Buscador articulo_________________________________________________________________

	$("#buscador").keyup(function (e) {

		if ($("#buscador").val()) {

			let buscador = $("#buscador").val();
			let fila = '';
			$.ajax({
				url: 'buscador.php',
				type: 'GET',
				data: { buscador },
				success: function (response) {
					let i = JSON.parse(response);

					i.forEach(i => {
						let cantidad = 'cant' + i.id_prod;
					fila += `
					<tr insumoid="${i.id_prod}" name="${i.nombre}">
					<td> 
					<button class="btn bg-success btn-sm float-left " id="agregar" >
					<i class="fa fa-plus"></i>
					</button> 
					</td>
					<td>${i.nombre}</td>
					<td><select  id='${i.id_prod}' class='form-control' required='' style='width:100px;' ><option value='0' >Elija</option><option value='Unidad'>Unidad</option><option value='Gramos'>Gramos</option><option value='Kg'>Kg</option><option value='Litro'>Litro</option><option value='Mililitro'>Mililitro</option></select></td>
					<td><input type="number" id='${cantidad}' style='width:80px;' /></td>

					</tr>`

					});
					$("#tabla").html(fila);
				}
			});
		}
		else {
			lista(0);
		}
	});





});





function editar_insumo(array,id) {
	LimpiarCampos();
	$.ajax({
		url: 'lista_insumo.php',
		type: 'POST',
		data: { 'array': JSON.stringify(array),
	'id':id},//capturo array 
		success: function (response) {
			$("#insumo_edit").html(response);
		}
	});
}







function editar_medida(medida) {

	LimpiarCampos();
	$.ajax({
		url: 'editar_medida.php',
		type: 'POST',
		data: { medida },
		success: function (response) {
			$("#medida_edit").html(response);
		}
	});
}












function RecorrerTabla() {

	var elemento = '';
	var fila = '';

	$("#example tbody tr").each(function () {

		let producto = $("#lista_producto").val();
		let elemento = $(this).find('td');
		let insumo = elemento.filter(":eq(0)").text();
		let cantidad = elemento.filter(":eq(2)").text();
		let medida = elemento.filter(":eq(3)").text();
		console.log(producto + insumo + " " + cantidad + " " + medida);

		$.post('agregar_receta.php', { producto, insumo, cantidad, medida }, function (response) {
			let res = JSON.parse(response);
			res.forEach(res => {
				if (res.respuesta == "fail") {
					return false;
				}
			});

		});
		return true;

	});


}



function lista_producto() {
	
	$.ajax({
		url: 'lista_producto.php',
		type: 'POST',
		success: function (response) {

			$("#lista_producto").html(response);

		}
	});
}

function eliminarTodasFilas() {

	$('#example tbody tr').each(function () {
		$(this).remove();
	});
}


function Eliminar(insumo, array) {


	for (var i = 0; i < array.length; i++) {
		if (array[i] == insumo) {
			array[i] = 0;
		}

	}


}


function Validar_existencia(insumo, array) {


	for (var i = 0; i < array.length; i++) {
		if (array[i] == insumo) {
			return false;
		}
	}
	return true


}


function LimpiarCampos() {
	$("#insumo_edit").html('<option value=""></option>');
	$("#medida_edit").html('<option value=""></option>');
}

function Titulo_Modal(flag) {
	if (flag) {
		$("#titulo_modal").html('<h5 class="modal-title " id="titulo_modal">Editar insumo</h5>');
	} else {
		$("#titulo_modal").html('<h5 class="modal-title " id="titulo_modal">Agregar insumo</h5>');

	}
}




function lista(id) {
	let fila = '';
	$.ajax({
		url: 'lista.php',
		type: 'POST',
		data: { id },
		success: function (response) {
			let i = JSON.parse(response);

			i.forEach(i => {
				let cantidad = 'cant' + i.id_prod;
				fila += `
				<tr insumoid="${i.id_prod}" name="${i.nombre}">
				<td> 
				<button class="btn bg-success btn-sm float-left " id="agregar" >
				<i class="fa fa-plus"></i>
				</button> 
				</td>
				<td>${i.nombre}</td>
				<td><select  id='${i.id_prod}' class='form-control' required='' style='width:100px;' ><option value='0' >Elija</option><option value='Unidad'>Unidad</option><option value='Gramos'>Gramos</option><option value='Kg'>Kg</option><option value='Litro'>Litro</option><option value='Mililitro'>Mililitro</option></select></td>
				<td><input type="number" id='${cantidad}' style='width:80px;' /></td>
				
				</tr>`

			});
			$("#tabla").html(fila);
		}
	});

	if (fila == '') {
		$("#tabla").html('');
	}
}





