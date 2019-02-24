@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-x-12">
			<h3>Salidas <a href="venta/create"><button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Salida</button></a></h3>
			@include('ventas.venta.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="table-resposive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Asesor (a)</th>
						<th>Comprobante</th>
						<th>Referencia</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach ($ventas as $ven)
               		@if($ven->estado == "A")
					<tr>
					@else
					<tr style="background: rgb(244, 66, 66); color: #fff; font-weight: bold;">
					@endif
						<td>{{ $ven->fecha_hora }}</td>
						<td>{{ $ven->nombre }}</td>
						<td>{{ $ven->tipo_comprobante.': '.$ven->num_comprobante }}</td>
						<td>{{ $ven->codigo }}</td>
						<!-- <td>{{ $ven->estado }}</td> -->
						<td>
						@if($ven->estado == "A")
							Activo
						@else
							Cancelado
						@endif
					</td>
						<td>
							<div class="col-lg-12 col-md-12 col-xs-12">
								<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-primary">Detalles</button></a>
								@if($ven->estado == "A")
								<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
							</div>
							@endif
						</td>
					</tr>
					@include('ventas.venta.modal')
					@endforeach
				</table>
			</div>
			{{$ventas->render()}}
		</div>
	</div>
@endsection