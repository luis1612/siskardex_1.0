<?php

namespace sisKardex;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //Referencciando la tabla a usar por el modelo
    protected $table ='ingreso';//tabla con la que se conecta

    protected $primaryKey ='idingreso'; //primaryKey de la tabla

    //Campo generado por laravel para la fecha y hora de actualización de registros
    public $timestamps = false;

    //Campos que se asignan al modelo
    protected $fillable = [
    	'idproveedor',
    	'tipo_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'estado'
    ];

    protected $guarded = [

    ];

    public function proveedor()
    {
     return $this->belongsTo('sisKardex\Persona','idproveedor','idpersona');
    }
}
