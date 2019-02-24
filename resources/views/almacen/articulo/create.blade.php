@extends ('layouts.admin')
@section ('contenido')
	
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Articulo</h3>
			<!--Verificamos las validaciones de errores a partir del CategoriaFormRequest-->
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

	<!--Agregamos nuestro formulario para crear nuevas categorias-->
	{!!Form::open(array('url'=>'almacen/articulo', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true'))!!}
	{{Form::token()}}
	<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<!--EL nombre del input debe ser igual a los colocados en CategoríaFormRequest
					El value es por si la página recarga el formulario y valida el nombre, el ingresado no se borre y vuelva a mostrarse para modificarse-->
				<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...."> 
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Categoría</label>
				<select name="idcategoria" class="form-control">
					@foreach($categorias as $cat)
						<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="codigo">Referencia</label>
				<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Referencia de Artículo...."> 
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="contenido">Contenido</label>
				<input type="text" name="contenido" required value="{{old('contenido')}}" class="form-control" placeholder="Contenido de Contenido...."> 
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="bodega">Bodega</label>
				<input type="text" name="bodega" required value="{{old('bodega')}}" class="form-control" placeholder="bodega del articulo..">
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="number" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del Artículo...."> 
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del Artículo...."> 
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label for="imagen">Imágen</label>
				<input type="file" name="imagen" class="form-control"> 
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>					
	</div>
	{!!Form::close()!!}

@endsection