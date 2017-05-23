<?php

namespace App\Modulos\Escuela;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Jornada extends Model
{
	protected $table = 'Jornadas';
    protected $primaryKey = 'Id_Jornada';
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];

    public function __construct()
    {
    	$this->table = config('database.connections.mysql.database').'.Jornadas';
    }

    public function promotor()
    {
    	return $this->belongsTo('App\Modulos\Escuela\Promotor', 'Id_Promotor');
    }

    public function parque()
    {
        return $this->belongsTo('App\Modulos\Parque\Parque', 'Id_Parque');
    }

    public function getCode()
    {
        return 'J'.str_pad($this->Id_Promotor, 5, '0', STR_PAD_LEFT);
    }

    use SoftDeletes, CascadeSoftDeletes;
}