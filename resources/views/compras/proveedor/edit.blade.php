@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar proveedor: <kbd class="bg-primary">{{$persona->nombre}}</kbd></h3>
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

{!!Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update', $persona->idpersona]])!!}
{{Form::token()}}
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre..">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Dirección</label>
				<input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control" placeholder="Dirección..">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Documento</label>
				<select name='tipo_documento' class="form-control">
					@if ($persona->tipo_documento == 'NIT')
						<option value="NIT" selected>NIT</option>
						<option value="RUT">RUT</option>
	
					@else ($persona->tipo_documento == 'RUT')
						<option value="NIT">NIT</option>   <!-- Número de Identificación Tributaria.-->
						<option value="RUT" selected>RUT</option>  <!-- Registro Único Tributario (RUT).-->

					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Número documento</label>
				<input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control" placeholder="Número de documento..">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono..">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="email">Correo electrónico</label>
				<input type="email" name="email" value="{{$persona->email}}" class="form-control" placeholder="Correo electrónico..">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<button class="btn btn-danger btn-block" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i></button>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<button href="compras/proveedor" class="btn btn-success btn-block"><i class="fa fa-reply" aria-hidden="true"></i></button>
			</div>	
		</div>
		</div>
		<!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div> -->
	</div>
{!!Form::close()!!}
@endsection