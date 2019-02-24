<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;

use sisKardex\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisKardex\Http\Requests\IngresoFormRequest;
use sisKardex\Ingreso;
use sisKardex\DetalleIngreso;
use DB;

use Carbon\Carbon; // para utilizar el formato de fecha y hora local
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

   //Todos estos metodos estan asociados con nuestras rutas resources
   public function index(Request $request)
   {
   		if($request)
   		{
   			$query=trim($request -> get('searchText'));
        $ingresos=DB::table('ingreso as i')
        ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
        ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
        ->select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante','i.num_comprobante','i.estado', DB::raw('i.estado ,COUNT(*) as total'))
        ->where('i.num_comprobante', 'LIKE', '%'.$query.'%')
            ->orwhere ('p.nombre','LIKE','%'.$query.'%')
        ->orderBy('i.idingreso', 'desc')
        ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.estado')
        ->paginate(10);
   			return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
   		}
   }
   public function create()
   {
   		//Obtenemos los proveedores
   		$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();
   		//Obtenemos los artículos
   		$articulos = DB::table('articulo as art')
         ->select(DB::raw('CONCAT("REF #",art.codigo, "-- ", art.nombre, "--  Bodega ", art.bodega) AS articulo'), 'art.idarticulo')
         ->where('art.estado', '=', 'Activo')
         ->get();

   		return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);
   }
   public function store(IngresoFormRequest $request)
   {
   		try{
   			DB::beginTransaction();
   			$ingreso = new Ingreso();
                $ingreso -> idproveedor = $request -> get('idproveedor');
                $ingreso -> tipo_comprobante = $request -> get('tipo_comprobante');
                //$ingreso -> serie_comprobante = $request -> get('serie_comprobante');
                $ingreso -> num_comprobante = $request -> get('num_comprobante');
                $mytime = Carbon::now('America/Bogota');
                $ingreso -> fecha_hora = $mytime -> toDateTimeString(); //lo convierto en un formato de fecha y hora
                $ingreso -> estado = 'A';
                $ingreso -> save();

                $idarticulo = $request -> get('idarticulo'); // array con los idarticulos
                $cantidad = $request -> get('cantidad');
                //$precio_compra = $request -> get('precio_compra');
                //$precio_venta = $request -> get('precio_venta');

                $cont = 0;

                while($cont < count($idarticulo))
                {

                    $detalle = new DetalleIngreso();
                    $detalle -> idingreso = $ingreso -> idingreso; // al crearse el objeto, se le asiga un id que aqui utilizo
                    $detalle -> idarticulo = $idarticulo[$cont]; // envia info de la posicion correspondiente
                    $detalle -> cantidad = $cantidad[$cont];
                    //$detalle -> precio_compra = $precio_compra[$cont];
                   // $detalle -> precio_venta = $precio_venta[$cont];
                    $detalle -> save();

                    $cont=$cont+1;

                }

            DB::commit();

   		}catch( \Exception $e)
   		{
   			DB::rollback();
   		}

   		return \Redirect::to('compras\ingreso');
   }
   public function show($id)
   {
   		$ingreso=DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
            ->select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.estado', DB::raw('i.estado,COUNT(*) as total'))
            ->where('i.idingreso', '=', $id)
            ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.num_comprobante', 'i.estado')
            ->first();

        $detalles=DB::table('detalle_ingreso as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select(DB::raw('CONCAT("REF #",a.codigo, "-- ", a.nombre, "--  Bodega ", a.bodega) AS articulo'),'d.cantidad')
            ->where('d.idingreso', '=', $id)
            ->get();

   		return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
   }
   public function detroy($id)
   {
	   	$ingreso = Ingreso::findOrFail($id);
	   	$ingreso->estado='C';
	   	$ingreso->update();
	   	return \Redirect::to('compras/ingreso');
   }
}
