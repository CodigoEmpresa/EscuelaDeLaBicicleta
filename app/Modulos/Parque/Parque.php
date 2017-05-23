<?php

namespace App\Modulos\Parque;

use Idrd\Parques\Repo\Parque as MParque;

class Parque extends MParque 
{
	public function jornadas()
	{
		return $this->hasMany('App\Modulos\Parque\Parque', 'Id_Parque');
	}
}