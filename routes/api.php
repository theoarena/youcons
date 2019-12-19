<?php

use Illuminate\Http\Request;

use App\User;
use App\Simulacao;
use App\Role;
use App\Voucher;
use App\Exports\adminSimulacaoExport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//pega os "tesouros" aka registro de cada voucher do cliente
Route::get('/tesouros', function(Request $request){

    $user = User::find($request->input('user_id'));    

    $tesouros = $user->tesouros()->get();

    return response()->json(
        [ $tesouros ]
    );   

})->name('api_gettesouros');

// mostra os vouchers na tabela (admin)
Route::get('/vouchers', function(Request $request){

    $sort = $request->query('orderBy', 'id');
    $direction = $request->query('direction', 'asc');
    $page = $request->query('page', 1) - 1; //deixa como zero     
    $q = $request->query('query',""); 
    $limit = Config::get('constants.list_qtdpage');

    $vouchers = new Voucher;

    if($q != "") //busca
        $vouchers = $vouchers->whereRaw("codigo LIKE '%".$q."%'");

    $vouchers = $vouchers->orderBy($sort, $direction)
   ->paginate($limit);

    return response()->json(
        [ 'items' =>  $vouchers]
    );   

})->name('api_getvouchers');

//valida o voucher e insere no histórico do usuario
Route::post('/vouchers/validate', function(Request $request){

    $codigo = $request->input("codigo", null);
    $user_id = $request->input("user_id", null);

    $hoje = date('Y-m-d');
    $voucher = Voucher::where('codigo',$codigo)->whereDate('valid_until','>=', $hoje )->first();
   
    if($voucher)
    {
        $user = User::find($user_id);
        //o usuario tem TESOUROS, não VOUCHERS
        $has_voucher = $user->tesouros()->where('vouchers.id',$voucher->id)->first();

        if( !$has_voucher ) //se não tiver 
        {
            //adiciona o tesouro
            $user->tesouros()->attach($voucher->id);
            //adiciona a Interação com a xp do voucher
            $user->addInteracao('easteregg-video',$voucher->experiencia);
            return response()->json(['status'=> 'voucher-inserido']);   
        }
        else
            return response()->json([ 'status'=>'voucher-jaexiste']);     
    }
    else
        return response()->json([ 'status'=>'voucher-naoencontrado']);

});

Route::post('/users/setyoucon/', function(Request $request){      
    $user = User::find( $request->input('user') );
    $user->tipo_youcon = $request->input('youcon');
    $user->active = 1;
    $user->save();    
});

Route::get('/users/{tipo?}', function($tipo = "cliente", Request $request){
 
    $sort = $request->query('orderBy', 'id');
    $direction = $request->query('direction', 'asc');
    $page = $request->query('page', 1) - 1; //deixa como zero 
    $active = $request->query('active', 2); //1 = sim, 0 = nao, 2 = todos
    $q = $request->query('query',""); 
    $limit = Config::get('constants.list_qtdpage');
 
   //todos os $tipo
    $users = User::whereHas( 'roles' , function ($q) use($tipo) { $q->where('name', $tipo); } );
          
    if($tipo == 'todos') //todos usuarios 
        $users = User::all();
   
    if($tipo == 'inativos') //usuarios não ativados
        $users = User::where('active',0)->whereDate('created_at','<=', date('Y-m-d H:i:s'));     
   
   if($q != "") //busca
    $users = $users->whereRaw("name LIKE '%".$q."%' OR email LIKE '%".$q."%'");

   if($active != 2)
     $users = $users->where('active',$active); 

   $users = $users->orderBy($sort, $direction)
   ->paginate($limit);   

    return response()->json(
        [ 'items' => $users ]
    );

})->name('api_getusers');

//pega as simulações (cliente e admin)
Route::get('/simulacoes/{cliente?}', function($cliente = null, Request $request){
 
    $q = $request->query('query',""); 
	$sort = $request->query('orderBy', 'id');
    $direction = $request->query('direction', 'asc');
    $favorite = $request->query('favorite', 2);
	$modalidade = $request->query('modalidade_id', 0);
	$page = $request->query('page', 1) - 1; //deixa como zero 
 	$limit = Config::get('constants.list_qtdpage');

    $periodo = json_decode($request->input('periodo',null));

    $simu = Simulacao::with(['cliente', 'vendedor.conta']);

    if($cliente != null)
        $simu = $simu->where('user_id',$cliente);

    if($favorite != 2) //todas
        $simu = $simu->where('favorite',$favorite);

    if($modalidade != 0) //todas
        $simu = $simu->where('modalidade_id',$modalidade);

    if($periodo != null)
        $sium = $simu->whereBetween('created_at', array($periodo->start, $periodo->end) );

    //if($q != "") //busca
    //    $simu = $simu->whereRaw("users.name LIKE '%".$q."%' OR users.email LIKE '%".$q."%'");     

        //whereNull('users.deleted_at')->
    $simu = $simu->orderBy($sort, $direction)->paginate($limit);    

    return response()->json(
        [ 'items' => $simu ]
    );

})->name('api_getsimulacoes');

Route::get('/simulacoes/{id?}', function($id, Request $request){

    $simu = Simulacao::find($id);
    return response()->json( [ $simu ] );

})->name('api_getsimulacao');

Route::post('/simulacoes/favorite/{id}/{value}', function($id,$value, Request $request){

    $simu = Simulacao::find($id);
    $simu->favorite = $value;
    $simu->save();
    return response()->json( [ 'status'=>'ok' ] );

})->name('api_setsimulacao-favorite');

Route::post('/simulacoes/save/', function(Request $request){

    //print_r($request->all());

    $credito = $request->input('data.credito');
    $parcela = $request->input('data.parcela');
    $lance = $request->input('data.lance');

   /* $formatter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
    $curr = "BRL";
    $credito = $formatter->parseCurrency($credito, $curr);  
    $parcela = $formatter->parseCurrency($parcela, $curr);     
    $lance = $formatter->parseCurrency($lance, $curr);     */

    $user = User::find($request->input('data.user'));
    //pega os tipos de simulação que não foram feitas por esse usuario
    $simu_naofeitas =  $user->getSimulacoesNaoFeitasTipo();

    $simu = new Simulacao;
    $simu->user_id = $request->input('data.user');
    $simu->modalidade_id = $request->input('data.modalidade');
    $simu->credito = $credito;
    $simu->parcela = $parcela;
    $simu->lance = $lance;
    $simu->pressa = $request->input('data.pressa');
    $simu->save();

    //se foi a primeira simulação
    if($user->qtd_simulacoes == 0)
        $user->addInteracao('1a-simulacao-site'); 
    //se não for a primeira verifica se esse tipo de modalidade não foi feito ainda
    else if(in_array( $request->input('data.modalidade') , $simu_naofeitas))
         $user->addInteracao('1a-simulacao-modalidade');    

    $user->increment('qtd_simulacoes'); //+1 na qtd de simulações
    $user->save();

    //$modalidades = $user->getSimulacoesModalidades();

    return response()->json( [ 'status'=>'ok' ] );

})->name('api_simulacao.save');

Route::get('/simulacoes/csv/get', function(Request $request){

    $params = array(
        "orderBy" => $request->input("orderBy","id"),
        "active" => $request->input("active",2),
        "direction" => $request->input("direction","asc"),
        "modalidade_id" => $request->input("modalidade_id",0),
        "periodo" => $request->input("periodo",null)
    ); 

    return Excel::download(new adminSimulacaoExport($params), 'simulacoes.xlsx');

    //return response()->file( $csv );

})->name('api_simulacao.csv');

Route::get('/users/remove/{id}', function($id, Request $request){

    DB::table('users')->where('id', $id)->delete();
    DB::table('user_voucher')->where('user_id', $id)->delete();
    DB::table('simulacoes')->where('user_id', $id)->delete();
    DB::table('role_user')->where('user_id', $id)->delete();
    DB::table('interacao_user')->where('user_id', $id)->delete();

    return response()->json( [ 'status'=>'ok' ] );

})->name('api_user.remove');

