<?php

namespace sisKardex\Http\Controllers;

use Illuminate\Http\Request;
use sisKardex\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisKardex\Http\Requests\VentaFormRequest;
use sisKardex\Venta; //modelo Venta
use sisKardex\DetalleVenta;//modelo DetalleVenta
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
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
            $ventas=DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->join('articulo as a','dv.idarticulo','=',"a.idarticulo")

            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante','a.codigo','v.estado', DB::raw('v.estado ,COUNT(*) as totalp'))
            ->where('v.num_comprobante', 'LIKE', '%'.$query.'%')
            ->orwhere ('p.nombre','LIKE','%'.$query.'%')
            ->orwhere ('a.codigo','LIKE','%'.$query.'%')
            ->orderBy('v.idventa','desc')
            ->groupBy('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante','a.codigo','v.totalp','v.estado')

            ->paginate(20);
   			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
   		}
   }
   public function create()
   {
   		//Obtenemos los Clientes
   		$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
   		//Obtenemos los artículos
   		$articulos = DB::table('articulo as art')
            ->join('detalle_ingreso as di', 'art.idarticulo', '=', 'di.idarticulo')
            ->select(DB::raw('CONCAT("REF #",art.codigo, " -- " ,art.contenido," -- " , art.nombre, " -- Bodega ", art.bodega) AS articulo'), 'art.idarticulo', 'art.stock',DB::raw('art.estado ,COUNT(*) as totalp')) //para hacer un promedio de todos los precios ingresados, si quiero el ultimo solo tengo que modificar esta ultima consulta
            ->where('art.estado', '=', 'Activo')
            ->where('art.stock', '>', '0')
            ->groupBy('articulo', 'art.idarticulo', 'art.stock','art.estado')
            ->get();
   		return view("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos]);
   }
   public function store(VentaFormRequest $request)
   {
   		try{
   			DB::beginTransaction();
   			 $venta = new Venta();
                $venta -> idcliente = $request -> get('idcliente');
                $venta -> tipo_comprobante = $request -> get('tipo_comprobante');
                $venta -> num_comprobante = $request -> get('num_comprobante');
                $venta -> totalp = $request -> get('totalp');
                $mytime = Carbon::now('America/Bogota');
                $venta -> fecha_hora = $mytime -> toDateTimeString(); //lo convierto en un formato de fecha y hora
                $venta -> estado = 'A';
                $venta -> save();

                $idarticulo = $request -> get('idarticulo'); // array con los idarticulos
                $cantidad = $request -> get('cantidad');
                $cont = 0;

                while($cont < count($idarticulo))
                {

                    $detalle = new DetalleVenta();
                    $detalle -> idventa = $venta -> idventa; // al crearse el objeto, se le asiga un id que aqui utilizo
                    $detalle -> idarticulo = $idarticulo[$cont]; // envia info de la posicion correspondiente
                    $detalle -> cantidad = $cantidad[$cont];
                    $detalle -> save();

                    $cont=$cont+1;

                }

            DB::commit();
        } catch(Exception $e)
        {
            DB::rollback();
        }

   		return \Redirect::to('ventas\venta');
   }
   public function show($id)
   {
   		$venta=DB::table('venta as v')
            ->join('persona as p', 'v.idcliente', '=', 'p.idpersona')
            ->join('detalle_venta as dv', 'v.idventa', '=', 'dv.idventa')
            ->join('articulo as a','dv.idarticulo','=',"a.idarticulo")
            ->select('v.idventa', 'v.fecha_hora', 'p.nombre', 'v.tipo_comprobante', 'v.num_comprobante','a.codigo','v.estado','v.totalp')
            ->where('v.idventa', '=', $id)
            ->first();

        $detalles=DB::table('detalle_venta as d')
            ->join('articulo as a', 'd.idarticulo', '=', 'a.idarticulo')
            ->select(DB::raw('CONCAT("REF #",a.codigo, " -- ", a.contenido," -- " , a.nombre, " --  Bodega ", a.bodega) AS articulo'),'d.cantidad')
            ->where('d.idventa', '=', $id)
            ->get();

   		return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
   }
   
   public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta -> estado = 'C';
        $venta -> update();

        return \Redirect::to('ventas/venta');
    }
}
