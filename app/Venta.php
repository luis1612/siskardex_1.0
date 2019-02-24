<?php

namespace sisKardex;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //Referencciando la tabla a usar por el modelo
    protected $table ='venta';

    protected $primaryKey ='idventa';

    //Campo generado por laravel para la fecha y hora de actualización de registros
    public $timestamps = false;

    //Campos que se asignan al modelo
    protected $fillable = [
    	'idcliente',
    	'tipo_comprobante',
    	//'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'totalp',
    	'estado'
    ];

    protected $guarded = [

    ];
     public function cliente()
    {
     return $this->belongsTo('sisKardex\Persona','idcliente','idpersona');
    }
}
