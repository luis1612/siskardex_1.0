@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Salida</h3>
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors -> all() as $error)
					<li>
						{{$errors}}
					</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::open(array('url' => 'ventas/venta', 'method' => 'POST', 'autocomplete' => 'off'))!!}
			{{Form::token()}}
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<label for="cliente">Asesor (a)</label>
				<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">
					@foreach($personas as $persona)
					<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label>Tipo comprobante</label>
				<select name='tipo_comprobante' class="form-control">
						<option value="Factura">Factura</option>
						<option value="Brilla">Brilla</option>
						<option value="R.C">Recibo caja</option>
						<option value="Exhibición">Exhibición</option>
						<option value="Remodelacion">Remodelación</option>
				</select>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="num_comprobante">Número comprobante</label>
				<input type="number" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Número comprobante..">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label>Artículo</label>
						<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
							@foreach($articulos as $articulo)
							<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->totalp}}">{{$articulo->articulo}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" step="any"name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad">
					</div>
				</div>
				<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
					<div class="form-group">
						<label for="stock">Stock</label>
						<input type="number" step="any" disabled name="pstock" id="pstock" class="form-control" placeholder="Stock..">
					</div>
				</div>
				
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
					</div>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<table id="detalles" class="table table-striped  table-bordered table-condensed table-hover">
						<thead style="background-color:#A9D0F5">
							<th>Opciones</th>
							<th>Artículo</th>
							<th>Cantidad</th>
							<th>Total </th>
						</thead>
						<tfoot>
							<th>TOTAL</th>
							<th></th>
							<th></th>
							<th><h4 id="total">Ctd/. 0.00</h4><input type="hidden" name="totalp" id="totalp"></th>
						</tfoot>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<input name="_token" value="{{ csrf_token() }}" type="hidden">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!}
	@push ('scripts')
		<script>

		$(document).ready(function()
			{$('#bt_add').click(function()
				{agregar();
				});
		});

		var cont=0;
		total=0.00;
		subtotal=[];
		$("#guardar").hide();
		$("#pidarticulo").change(mostrarValores);

			function mostrarValores()
			{
				datosArticulo = document.getElementById('pidarticulo').value.split('_'); //en mi variable datosArticulo obtengo los valores separados con el _ con el id pidarticulo
				$("#pstock").val(datosArticulo[1]);
			}

			function agregar()
			{
				datosArticulo = document.getElementById('pidarticulo').value.split('_'); //en mi variable datosArticulo obtengo los valores separados con el _ con el id pidarticulo
				idarticulo = datosArticulo[0];
				articulo = $("#pidarticulo option:selected").text(); //obtengo el texto de la opcion seleccionada
				cantidad = $("#pcantidad").val();
				stock = $("#pstock").val();

				if(idarticulo!="" && cantidad!="")
				{

					if (stock>=cantidad)
					{
						subtotal[cont]=(cantidad);
						total=total+subtotal[cont];

						var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"><td>'+subtotal[cont]+'</td></tr>';
						cont++;
						limpiar();
						$("#total").html("$/. "+total);
						$("#totalp").val(total);
						evaluar();
						$('#detalles').append(fila);
					}
					else
					{
						alert ('La cantidad en salida  supera al stock')
					}	
				}
				else
				{
					alert('Error al ingresar el detalle de la salida, revise los datos del articulo');
				}

			}


			function limpiar()
			{
				$("#pcantidad").val("");

			}

			function evaluar()
			{
				if(total>0.00)
				{
					$("#guardar").show();
				}
				else
				{
					$("#guardar").hide();
				}
			}

			function eliminar(index)
			{
				total=total-subtotal[index];
				$("#total").html("Ctd./. " + total);
				$("#totalp").val(total);
				$("#fila" + index).remove();
				evaluar();
			}

		</script>
	@endpush
@endsection