@extends ('layouts.admin')
@section ('contenido')
<div class="row">
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <h3>Kardex del producto : <strong>" {{ $articulo->nombre }} - {{ $articulo->codigo }} - {{ $articulo->contenido }}- {{ $articulo->bodega }}" - </strong>  Existencia Actual :  <strong> {{ $articulo->stock }}</strong> </h3> 
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="table-responsive bg-success">
      <table id="testTable" class="table table-striped table-bordered table-condensed table-hover " id="kardex_salida" width="100%">
        <caption><strong>KARDEX DE SALIDA</strong></caption>
        <p class="hidden" >{{$cantidad_salida=0}}</p>
        <thead>
          <tr>
                      <th>Fecha de salida</th>
                      <th>Cantidad</th>
                      <th>tipo Comprobante</th>
                      <th>Numero Comprobante</th>
                      <th>Asesor (a)</th>
                  </tr>
        </thead>
        <tbody>
          @foreach ($kardex_salida as $salida)
          @if($salida->venta->estado == "A" )
          <p class="hidden">{{$cantidad_salida=$cantidad_salida+$salida->cantidad}}</p>
          <tr>
            <td >{{ $salida->venta->fecha_hora }}</td>
            <td>{{ $salida->cantidad }}</td>
            <td>{{ $salida->venta->tipo_comprobante }}</td>
            <td>{{ $salida->venta->num_comprobante }}</td>
            <td>{{ $salida->venta->cliente->nombre }}</td>
          </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot>
          <tr>
                        <td><strong>Total Salidas:</strong></td>
                        <td><strong>{{ $cantidad_salida }}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="table-responsive bg-success">
      <table id="ttTable" class="table table-striped table-bordered table-condensed table-hover" id="kardex_entrada" width="100%">
        <caption><strong>KARDEX DE ENTRADA</strong></caption>
        <p class="hidden">{{$cantidad_entrada=0}}</p>
        <thead>
          <tr>
                      <th>Fecha de entrada</th>
                      <th>Cantidad</th>
                      <th>Tipo Comprobante</th>
                      <th>Numero Comprobante</th>
                      <th>Proveedor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kardex_entrada as $entrada)
          @if($entrada->ingreso->estado == "A")
          <p class="hidden">{{$cantidad_entrada=$cantidad_entrada+$entrada->cantidad}}</p>
          <tr>
            <td>{{ $entrada->ingreso->fecha_hora }}</td>
            <td>{{ $entrada->cantidad }}</td>
            <td>{{ $entrada->ingreso->tipo_comprobante }}</td>
            <td>{{ $entrada->ingreso->num_comprobante }}</td>
            <td>{{ $entrada->ingreso->proveedor->nombre }}</td>
          </tr>
          @endif
          @endforeach
        </tbody>
        <tfoot>
          <tr>
                        <td><strong>Total Entradas:</strong></td>
                        <td><strong>{{ $cantidad_entrada }}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endpush
@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function () {
    $('#kardex_salida').DataTable({
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
    $('#kardex_entrada').DataTable({
        "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
</script>
@endpush
@endsection