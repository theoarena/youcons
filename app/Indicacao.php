<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    protected $table = "indicacoes";     

    public function indicado()
    {
      return $this->belongsTo('App\User')->withTimestamps();
    } 

}
