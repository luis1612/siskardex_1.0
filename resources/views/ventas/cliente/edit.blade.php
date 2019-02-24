@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Asesor (a): <kbd class="bg-primary">{{$persona->nombre}}</kbd></h3>
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

{!!Form::model($persona,['method'=>'PATCH','route'=>['ventas.cliente.update', $persona->idpersona]])!!}
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
					@if ($persona->tipo_documento == 'C.C.')
						<option value="C.C." selected> C.C.</option>
						<option value="T.I">T.I</option>
						<option value="PASS">PASS</option>
					@elseif ($persona->tipo_documento == 'T.I')
						<option value="C.C."> C.C.</option>
						<option value="T.I" selected>T.I</option>
						<option value="PASS">PASS</option>
					@else
						<option value=" C.C."> C.C.</option>
						<option value="T.I">T.I</option>
						<option value="PASS" selected>PASS</option>
					@endif
				</select>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="num_documento">Número de documento</label>
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
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div> 
	</div>
{!!Form::close()!!}
@endsection