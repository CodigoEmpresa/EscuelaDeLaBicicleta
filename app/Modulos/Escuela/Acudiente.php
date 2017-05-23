<?php

namespace App\Modulos\Escuela;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Acudiente extends Model
{
	protected $table = 'Acudientes';
    protected $primaryKey = 'Id_Acudiente';
    protected $connection = 'mysql';
    protected $dates = ['deleted_at'];

    public function __construct()
    {
    	$this->table = config('database.connections.mysql.database').'.Acudientes';
    }

    public function persona()
    {
    	return $this->belongsTo('App\Modulos\Persona\Persona', 'Id_Persona');
    }

    public function usuarios()
    {
    	return $this->hasMany('App\Modulos\Escuela\Usuario', 'Id_Acudiente');
    }

    public function getCode()
    {
        return 'J'.str_pad($this->Id_Acudiente, 5, '0', STR_PAD_LEFT);
    }

    use SoftDeletes, CascadeSoftDeletes;
}