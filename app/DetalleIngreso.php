<?php

namespace sisKardex;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //Referencciando la tabla a usar por el modelo
    protected $table ='detalle_ingreso'; //tabla con la que se conecta

    protected $primaryKey ='iddetalle_ingreso'; //primaryKey de la tabla

    //Campo generado por laravel para la fecha y hora de actualización de registros
    public $timestamps = false;

    //Campos que se asignan al modelo
    protected $fillable = [
    	'idingreso',
    	'idarticulo',
    	'cantidad'
    ];

    protected $guarded = [

    ];

    public function ingreso() 
    {
     return $this->HasOne('sisKardex\Ingreso','idingreso','idingreso');
    }
}
