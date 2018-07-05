<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interacao extends Model
{
    protected $table = "interacoes";       

    public function users()
    {
      return $this->belongsTo('App\User')->withTimestamps();
    } 

}
