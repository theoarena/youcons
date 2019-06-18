<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consorcio extends Model
{

	protected $table = 'consorcios';

	protected $dates = ['deleted_at','created_at'];

	public function cliente()
	{
	    return $this->belongsTo('App\User','user_id');
	}

	public function simulacao()
	{
	    return $this->belongsTo('App\Simulacao');
	}

}
