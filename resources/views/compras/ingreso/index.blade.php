@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-x-12">
			<h3>Ingresos <a href="ingreso/create"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Ingreso</button> </a></h3>
			@include('compras.ingreso.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="table-resposive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Proveedor</th>
						<th>Comprobante</th>
						<th>Total</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
               @foreach ($ingresos as $ing)
				@if($ing->estado == "A")
				<tr>
				@else
				<tr style="background: rgb(244, 66, 66); color: #fff; font-weight: bold;">
				@endif
						<td>{{ $ing->fecha_hora }}</td>
						<td>{{ $ing->nombre }}</td>
						<td>{{ $ing->tipo_comprobante.': '.$ing->num_comprobante.'-'}}</td>
						<td>{{ $ing->total }}</td>
						<td>
						@if($ing->estado == "A")
							Activo
						@else
							Cancelado
						@endif
					</td>
						<td>
							<a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"><button class="btn btn-primary">Detalles</button></a>
							@if($ing->estado == "A")
							<!--Referenciamos al modal para eliminar Clientes-->
							<a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
							@endif
						</td>
					</tr>
					<!--Incluimos el modal para generar-->
					@include('compras.ingreso.modal')
					@endforeach
				</table>
			</div>
			<!--Mostramos la paginacion-->
			{{$ingresos->render()}}
		</div>
	</div>
@endsection