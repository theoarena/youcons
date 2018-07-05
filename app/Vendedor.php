<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Vendedor extends User
{
    use SoftDeletes; 

    protected $table = "vendedores";

    protected $dates = ['deleted_at'];
     
    protected $fillable = [
    //    'name', 'email', 'password',
    ];

    public function conta()
    {
      return $this->belongsTo('App\User','user_id');
    }

    public function simulacoes()
    {
        return $this->hasMany('App\Simulacao');
    }

}
