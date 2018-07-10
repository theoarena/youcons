<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulacao extends Model
{

	protected $table = 'simulacoes';

	protected $dates = ['deleted_at','created_at'];

	protected $fillable = [
        'credito', 'lance', 'parcela','pressa', 'modalidade_id'
    ];

	public function cliente()
	{
	    return $this->belongsTo('App\User','user_id');
	}

	public function vendedor()
	{
	    return $this->belongsTo('App\Vendedor', 'vendedor_id');
	}

	public static function pending()
    {
      return Simulacao::where('active',0)->whereDate('created_at','<=', date('Y-m-d H:i:s'))->get();
    }
	
	/* 
		Como só há 3 tipos de modalidades, não há necessidade de fazer um model, etc.
		Aqui é retornado um array contendo os ID's das modalidades: imob, veicular, serviços

	 */
	public static function getAllModalidadesTipos()
	{
		return [1,2,3];
	}

    public function getCreatedAtAttribute($value)
	{
		return formatDate($value,'d/m/Y');		
	}

	public function getFavoriteAttribute($value)
	{
		return ($value == 1)?"Sim":"Não";
	}

	public function getPressaAttribute($value)
	{
		switch((int)$value){			
			case 1: $str = "Pouca";break;
			case 2: $str = "Média";break;
			case 3: $str = "Alta";break;
			default: $str = "Não informado";break;
		}

		return $str;	
	}	

	public function getModalidadeIdAttribute($value)
	{		
		$str = "";

		switch((int)$value){			
			case 1: $str = "Imobiliário";break;
			case 2: $str = "Veicular";break;
			case 3: $str = "Serviços";break;
		}

		return $str;	
	}

	public function getFormattedCurrency($column)
	{	
		switch ($column) {
			case 'credito': $campo = $this->credito; break;
			case 'lance': $campo = $this->lance; break;
			case 'parcela': $campo = $this->parcela; break;			
		}		        
		
		return 'R$ ' . number_format($campo, 2, ',', '.');     
        
	}
}
