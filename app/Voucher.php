<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
	use SoftDeletes;

    protected $table = "vouchers";  

    protected $dates = ['deleted_at'];     

    public function users()
    {
      return $this->belongsTo('App\User')->withTimestamps();
    } 

}
