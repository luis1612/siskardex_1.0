@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Artículos
			<a href="articulo/create">
				<button class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
			</a>
			<!--input type="button" onclick="tableToExcel('testTable', 'Listado Productos')" value="Excel">-->
		</h3>
		@include('almacen.articulo.search')
	</div>	
</div>

<div class="row" >
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table  id="testTable" class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Ref.</th>
					<th>Contenido</th>
					<th>Bodega</th>
					<th>Categoría</th>
					<th>Stock</th>
					<th>Imagen</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>

				@foreach ($articulos as $art)
				<tr>
					<td>{{$art->idarticulo}}</td>
					<td>{{$art->nombre}}</td>
					<td>{{$art->codigo}}</td>
					<td>{{$art->contenido}}</td>
					<td>{{$art->bodega }}</td>
					<td>{{$art->categoria }}</td>
					<td>{{$art->stock}}</td>
					<td>
						<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
					</td>
					<td>{{$art->estado}}</td>
					<td>
						<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
						<a href="{{URL::action('ArticuloController@kardex',$art->idarticulo)}}"><button class="btn btn-warning">Kdx</button></a>
                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
					</td>
				</tr>
				<!--Incluimos el modal para generar-->
				@include('almacen.articulo.modal')
				@endforeach

			</table>
		</div>
		<!--Mostramos la paginacion-->
		{{$articulos->render()}}
	</div>		

</div>

@endsection
