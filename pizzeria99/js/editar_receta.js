$(document).ready(function () {

	array = [0];

	lista_producto();
	lista_medida(0);
	producto_elaborado();



	if ($("#on").val() == "receta" || $("#on").val() == "editar_receta") {
		$("#receta").addClass("menu-open");
	}

	var id_prod = $("#producto_elaborado").val();

	$("#btn_add").click(function () {
		let producto = $("#producto_elaborado").val();
		lista(producto);
		console.log(array);
	});

	$(document).on('click', '#agregar', function () {

		let elemento = $(this)[0].parentElement.parentElement;
		let insumo = $(elemento).attr('insumoid');
		let cantidad = $("#cant" + insumo).val();
		let medida = $("#" + insumo).val();


		console.log(insumo + medida + cantidad);


		if (medida == 0 || cantidad <= 0) {
			toastr.warning("Rellenar todos los campos!")
		}
		else if (medida == 0) {
			toastr.warning("Debes seleccioar una medida!")
		}
		else if (cantidad <= 0) {
			toastr.warning("Cantidad debe ser mayor a cero!")
		}

		else if (Validar_existencia(insumo, array)) {
			array.push(parseInt(insumo));
			//agregar fila
			let producto = $("#producto_elaborado").val();

			$.post('agregar_receta.php', { producto, insumo, cantidad, medida }, function (response) {
				lista_receta(producto, array);
				console.log(response);
			});
			$("#cant" + insumo).val('');
			$("#search" + insumo).val('');

		}
		else {
			toastr.warning("No se puede agregar insumos existentes!")

		}

	});



	$("#buscador").keyup(function (e) {
		let producto = $("#producto_elaborado").val();


		if ($("#buscador").val()) {
			console.log("buscador_" + $("#buscador").val());

			let buscador = $("#buscador").val();
			let fila = '';
			$.ajax({
				url: 'buscador_insumo.php',
				type: 'GET',
				data: { buscador },
				success: function (response) {
					let receta = JSON.parse(response);

					receta.forEach(receta => {
						array.push(parseInt(receta.id_insumo));
						fila += `
				<input type="hidden" id='idr' value='${receta.id_receta}'/>
				<tr recetaid="${receta.id_receta}"  insumoid="${receta.id_insumo}">
				<th>${receta.nombrei}</th>
				<th>${receta.cantidad}</th>
				<th>${receta.medida}</th>
				<th> 
				<button class="btn btn-danger btn-sm float-right " id="eliminar" style="width:30px">
				<i class="fa fa-trash"></i>
				</button> 
				<button class="btn bg-orange btn-sm float-right" id="editar_receta" data-toggle="modal" data-target="#modal-default" style="width:30px">
				<i class="fa fa-edit"></i>
				</button>
				</th>
				</tr>`
						$("#tabla").html(fila);
					});
				}
			});
		}
		else {
			lista_receta(producto, array);
		}
	});






	$("#search").keyup(function (e) {

		if ($("#search").val()) {
			console.log("buscador_" + $("#search").val());

			let buscador = $("#search").val();
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
						$("#tabla_insumo").html(fila);


					});
				}
			});
		}
		else {
			lista(id_prod);
		}
	});

	$("#form").submit(function (e) {
		e.preventDefault();

		const datos = {
			id_receta: $("#id_receta").val(),
			insumo: $("#insumo_edit").val(),
			medida: $("#medida_edit").val(),
			cantidad: $("#cantidad_edit").val()

		};

		console.log(datos);
		$.post('actualizar_receta.php', datos, function (response) {
			console.log(response);

			let res = JSON.parse(response);

			res.forEach(res => {
				if (res.respuesta == "ok") {
					toastr.success('Actualizado Correctamente');
				}
				else if (res.respuesta == "fail") {
					toastr.error('fallo al actualizar', 'Hubo un error');
				}
			});


			let producto = $("#producto_elaborado").val();
			lista_receta(producto, array);
		});


	});


	//actualizar informacion______________________________________________________________

	$(document).on('click', '#editar_receta', function () {
		actualizar = true;
		let elemento = $(this)[0].parentElement.parentElement;
		let id = $(elemento).attr('recetaid');
		var idm = '';
		var id_insumo = '';
		let producto = $("#producto_elaborado").val();
		$.post('get_data_receta.php', { id }, function (response) {

			let receta = JSON.parse(response);

			receta.forEach(receta => {
				idm = receta.id_medida;
				id_insumo = receta.id_insumo;
				console.log("ress:" + idm);
				$("#cantidad_edit").val(receta.cantidad);
				$("#id_receta").val(receta.id_receta);

				var insumo = `<option value="${receta.id_insumo}">${receta.nombrei}</option>`;
				$("#insumo_edit").html(insumo);

				var medida = `<option value="${receta.id_medida}">${receta.medida}</option>`;
				$("#medida_edit").html(medida);

			});

			lista_medida(idm);
			lista_insumo(producto);
		});



	});

	$("#btn_add").attr('disabled', true);


	$("#producto_elaborado").change(function () {
		let producto = $("#producto_elaborado").val();

		if (producto > 0) {
			console.log(producto);
			$("#insumo").attr('disabled', false);
			$("#eliminar_receta").attr('disabled', false);
			$("#btn_add").attr('disabled', false);


			lista_insumo(producto);
			lista_receta(producto, array);
		}
		else if (producto == 0) {
			eliminarTodasFilas();
			console.log(producto);

			$("#insumo").attr('disabled', true);
			$("#eliminar_receta").attr('disabled', true);
			$("#btn_add").attr('disabled', true);



		}

	});



	//_eliminar insumos___________________________________________________________
	$(document).on("click", "#eliminar", function () {

		if (confirm('Estas seguro?')) {
			let producto = $("#producto_elaborado").val();
			let elemento = $(this)[0].parentElement.parentElement;
			let insumo = $(elemento).attr('insumoid');
			let id = $(elemento).attr('recetaid');
			console.log(insumo);
			var res = '';
			$.post('eliminar.php', { id }, function (response) {
				lista_receta(producto, array);
				let res = JSON.parse(response);
				console.log(response);
				res.forEach(res => {
					if (res.respuesta == "ok") {
						toastr.success('Eliminado Correctamente');
						Eliminar(insumo, array);
						lista_insumo(producto);
					}
					else if (res.respuesta == "fail") {
						toastr.error('fallo al intentar eliminar ', 'Hubo un error');
					}
				});
			});
		}

	});


	$(document).on("click", "#eliminar_receta", function () {

		if (confirm('Estas seguro?')) {
			let id = $("#producto_elaborado").val();
			var res = '';
			$.post('eliminar_receta.php', { id }, function (response) {
				producto_elaborado();
				lista_receta(id, array);
				let res = JSON.parse(response);
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
		lista_insumo(id);

	});


	$("#form_insumo").submit(function (e) {
		e.preventDefault();

		let producto = $("#producto_elaborado").val();
		let insumo = $("#insumo").val();
		let cantidad = $("#cantidad").val();
		let medida = $("#unidad_medida").val();

		$.post('agregar_receta.php', { producto, insumo, cantidad, medida }, function (response) {
			lista_insumo(producto);
			lista_receta(producto, array);
		});


	});






	$('#unidad_medida').select2({
		theme: 'bootstrap4'
	});

	$('#medida_edit').select2({
		theme: 'bootstrap4'
	});



	$('#insumo').select2({
		theme: 'bootstrap4'
	});

	$('#insumo_edit').select2({
		theme: 'bootstrap4'
	});


	$('#tipo').select2({
		theme: 'bootstrap4'
	});

	$('.prod').select2({

	});


	$("#insumo").attr('disabled', true);
	$("#eliminar_receta").attr('disabled', true);


	$("#lista_producto").change(function () {
		let producto = $("#lista_producto").val();

		if (producto > 0) {
			$("#insumo").attr('disabled', false);
			lista_insumo(producto);
		}
		else {
			$("#insumo").attr('disabled', true);
		}
	});

});





function Validar_existencia(id) {

	var elemento = '';
	var fila = '';


	$("#tabla tbody tr").each(function () {

		elemento = $(this).find('td');
		fila = elemento.filter(":eq(1)").text();

		fila = parseInt(fila);
		console.log(fila);
		if (fila == insumo) {
			return 1;
		}
	});
	return 0;
}







function lista_medida(idm) {
	$.ajax({
		url: 'lista_medida_editar.php',
		type: 'POST',
		data: { idm },
		success: function (response) {
			$("#medida_edit").append(response);
			$("#unidad_medida").html(response);

		}
	});
}

function lista_insumo(producto) {

	$.ajax({
		url: 'lista_insumo_editar.php',
		type: 'POST',
		data: { producto },
		success: function (response) {
			$("#insumo_edit").append(response);
			$("#insumo").html(response);
		}
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




function producto_elaborado() {

	$.ajax({
		url: 'producto_elaborado.php',
		type: 'POST',
		success: function (response) {
			console.log(response);
			$("#producto_elaborado").html(response);

		}
	});
}

function Validar_existencia(insumo, array) {


	for (var i = 0; i < array.length; i++) {
		if (array[i] == insumo) {
			return false;
		}
	}
	return true;


}


function Eliminar(insumo, array) {


	for (var i = 0; i < array.length; i++) {
		if (parseInt(array[i]) == parseInt(insumo)) {
			array[i] = 0;
		}

	}
	console.log(array);


}


function lista_receta(id, array) {
	let fila = '';
	$.ajax({
		url: 'lista_receta.php',
		type: 'POST',
		data: { id },
		success: function (response) {
			let recetas = JSON.parse(response);

			recetas.forEach(receta => {
				let id_insumo = parseInt(receta.id_insumo);
				array.push(id_insumo);

				fila += `
				<input type="hidden" id='idr' value='${receta.id_receta}'/>
				<tr recetaid="${receta.id_receta}"  insumoid="${receta.id_insumo}">
				<th>${receta.nombrei}</th>
				<th>${receta.cantidad}</th>
				<th>${receta.medida}</th>
				<th> 
				<button class="btn btn-danger btn-sm float-right " id="eliminar" style="width:30px">
				<i class="fa fa-trash"></i>
				</button> 
				<button class="btn bg-orange btn-sm float-right" id="editar_receta" data-toggle="modal" data-target="#modal-default" style="width:30px">
				<i class="fa fa-edit"></i>
				</button>
				</th>
				</tr>`
				$("#tabla").html(fila);
			});
		}
	});

	if (fila == '') {
		$("#tabla").html('');
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
			$("#tabla_insumo").html(fila);
		}
	});

	if (fila == '') {
		$("#tabla_insumo").html('');
	}
}

//Buscador cliente_________________________________________________________________
function eliminarTodasFilas() {
	console.log('ee');
	$('#tabla tbody tr').each(function () {
		$(this).remove();
	});
}