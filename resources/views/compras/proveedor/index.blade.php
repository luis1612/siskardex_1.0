@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Proovedores
			<a href="proveedor/create">
				<button class="btn btn-success">Nuevo</button>
			</a>
		</h3>
		@include('compras.proveedor.search')
	</div>	
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  class="table table-striped table-bordered table-condensed table-hover">

				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo Doc.</th>
					<th>Núm. Doc.</th>
					<th>Telefono</th>
					<th>Email</th>
				</thead>

				@foreach ($personas as $per)
				<tr>
					<td>{{$per->idpersona}}</td>
					<td>{{$per->nombre}}</td>
					<td>{{$per->tipo_documento}}</td>
					<td>{{$per->num_documento}}</td>
					<td>{{$per->telefono}}</td>
					<td>{{$per->email}}</td>
					<td>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"><button class="btn btn-info btn-block"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<!--Referenciamos al modal para eliminar Clientes-->
							<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
							</div>
						</td>
					</tr>
					<!--Incluimos el modal para generar-->
					@include('compras.proveedor.modal')
					@endforeach
				</table>
			</div>
			<!--Mostramos la paginacion-->
			{{$personas->render()}}
		</div>
	</div>
@endsection