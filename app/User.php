<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Interacao;
use App\Voucher;
use App\Simulacao;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }  

    public function interacoes()
    {
      return $this->belongsToMany('App\Interacao');
    }  

    //o usuário tem TESOUROS, não VOUCHERS. Voucher é só o nome interno
    public function tesouros()
    {
      return $this->belongsToMany('App\Voucher', 'user_voucher');
    }  

    public function simulacoes()
    {
        return $this->hasMany('App\Simulacao');
    }

    public function indicacao()
    {
        return $this->hasOne('App\Indicacao','indicado_id');
    }
    
    public function addRole($role)
    {
      if( !$this->hasRole($role) )
        $this->roles()->attach( Role::where('name', $role)->first() );      
    }

    public function hasAnyRole($roles)
    {
      return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->first();
    }

    public static function activationRequired()
    {
      return User::where('active',0)->whereDate('created_at','<=', date('Y-m-d H:i:s'))->get();
    }

    public function getCreatedAtAttribute($value)
    {
      return formatDate($value,'d/m/Y');    
    }

    public function getSimulacoesNaoFeitasTipo()
    {     
      $feitas = DB::table('simulacoes')->where('user_id',$this->id)->pluck('modalidade_id');       
      $todas = Simulacao::getAllModalidadesTipos();               
      return array_diff( $todas,$feitas->toArray() );    
    }

    public function addInteracao($tipo,$xp = null)
    {      
      $id = 0;

      switch ($tipo) {
        case 'criou-conta': $id = 1;break; 
        case '1a-simulacao-site': $id = 2;break; 
        case '1a-simulacao-modalidade': $id = 3;break; 
        case '1o-consorcio-contratado': $id = 4;break; 
        case 'mais-consorcio-contratado': $id = 5;break; 
        case 'indicacao-cadastro': $id = 6;break; 
        case 'indicacao-consorcio': $id = 7;break; 
        case 'easteregg-video': $id = 8;break; 
      }

      $interacao = Interacao::find($id);
      $this->interacoes()->attach($interacao);// adiciona um registro da interação     

      $experiencia = ($xp != null)?$xp:$interacao->experiencia;

      $xp = $this->experiencia + $experiencia;
      $this->nivel = $this->getProgresso("nivel",$xp);
      $this->experiencia = $xp; 
      $this->save();
    }

    public function getFirstName()
    {      
      $name = explode(" ",$this->name);
      return $name[0].( ( isset($name[1]) )?( " ".$name[1] ):"" );      
    }

    public function getAvatar()
    {
      return Storage::url('avatars/'.$this->avatar); 
    }
    
    public function getPontosRestantes()
    {
    }

    public function getProgresso($return = "total",$experiencia = 0)
    {
      $xp = ($experiencia != 0)?$experiencia:$this->experiencia;
      $str = "";

      switch (true) {
        case ($xp < 500):  $nivel = 1; $total =  500;  break; //1
        case ($xp < 1000): $nivel = 2; $total = 1000; break; //2
        case ($xp < 1500): $nivel = 3; $total = 1500; break; //3
        case ($xp < 2000): $nivel = 4; $total = 2000; break; //4
        case ($xp < 2500): $nivel = 5; $total = 2500; break; //5
        case ($xp < 3000): $nivel = 6; $total = 3000; break; //6
        case ($xp < 3500): $nivel = 7; $total = 3500; break; //7
        case ($xp < 4000): $nivel = 8; $total = 4000; break; //8
        case ($xp < 5000): $nivel = 9; $total = 5000; break; //9    
        case ($xp >= 5000): $nivel = 10; $total = 5000; break; //10    
      }

      if($return == "total")
        $str = $xp."/".str_replace("%total%", $total , "<span>%total%</span>");
      else
        return $nivel;

      echo ($str);

    }
  
    public function getCategoria()
    {     
      $str = "";
         
      switch ($this->nivel) {        
        case 1: $str = "Youcon baby"; break;
        case 2: $str = "Youcon iniciante"; break;
        case 3: $str = "Youcon intermediário"; break;
        case 4: $str = "Youcon avançado"; break;
        case 5: $str = "Youcon avançado plus"; break;
        case 6: $str = "Youcon avançado master"; break;
        case 7: $str = "Youcon ultimate"; break;
        case 8: $str = "Youcon ultimate plus"; break; 
        case 9: $str = "Youcon ultimate master"; break;       
        case 10: $str = "Youcon ultimate master"; break;        
       
      }

      return $str;
    }

    public function sendMailUserCreated($pass = "")
    {      
      //TODO
      //fazer fila
      Mail::to($this->email)->send(new UserCreated($this, $pass));      
    }

}
