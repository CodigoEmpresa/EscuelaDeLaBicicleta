<?php

namespace App\Modulos\Escuela;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Usuario extends Model
{
	protected $table = 'Usuarios';
    protected $primaryKey = 'Id_Usuario';
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];

    public function __construct()
    {
    	$this->table = config('database.connections.mysql.database').'.Usuarios';
    }

    public function persona()
    {
    	return $this->belongsTo('App\Modulos\Persona\Persona', 'Id_Persona');
    }

    public function acudiente()
    {
    	return $this->belongsTo('App\Modulos\Escuela\Acudiente', 'Id_Acudiente');
    }

    public function jornadas()
    {
    	return $this->belongsToMany('App\Modulos\Escuela\Jornada', 'Jornadas_Usuarios', 'Id_Usuario', 'Id_Jornada')
    				->withPivot('Hora_Inicial', 'Hora_Final', 'Destreza_Inicial', 'Avance_Logrado', 'Observaciones');
    }

    public function getCode()
    {
        return 'J'.str_pad($this->Id_Usuario, 5, '0', STR_PAD_LEFT);
    }

    use SoftDeletes, CascadeSoftDeletes;
}