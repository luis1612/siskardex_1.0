<?php

namespace sisKardex;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //Referencciando la tabla a usar por el modelo
    protected $table ='detalle_venta';

    protected $primaryKey ='iddetalle_venta';

    //Campo generado por laravel para la fecha y hora de actualización de registros
    public $timestamps = false;

    //Campos que se asignan al modelo
    protected $fillable = [
    	'idventa',
    	'idarticulo',
    	'cantidad',
        'promedio',
    ];

    protected $guarded = [

    ];
    
     public function venta()
    {
     return $this->HasOne('sisKardex\Venta','idventa','idventa');
    }
}
