<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator;
use App\User;
use App\Simulacao;
use App\Role;
use App\Indicacao;

use App\Mail\UserCreated;
use App\Mail\IndicacaoCreated;
use App\Mail\Contato;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Jobs\IndicacaoEmailJob;




class HomeController extends Controller
{  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create('App\Forms\HomeForm', [
            'method' => 'POST',
            'url' => route('simulacao_home')            
        ]);

        $form_contato = $formBuilder->create('App\Forms\ContatoForm', [
            'method' => 'POST',
            'url' => route('contato_home')            
        ]);

        return view('home-site', array('form' => $form, 'form_contato' => $form_contato) );
    }



     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function landing_page(Request $request, FormBuilder $formBuilder)
    {
       $form = $formBuilder->create('App\Forms\LandingForm', [
            'method' => 'POST',
            'url' => route('landing_page')
        ]);

       if ($request->isMethod('post')) {

               $messages = [
                   'modalidade.required' => 'Por favor, selecione uma modalidade!',
                   'email.unique' => 'Este email já foi utilizado! Utilize a área de clientes para acessar sua conta.'
               ];

               //validações

               $validator = Validator::make($request->all(), [
                   'nome' => 'required|max:60',
                   'email' => 'required|unique:users,email|email|max:50', //unique:users,email
                   'telefone' => 'required|max:50',
                   'modalidade' => 'required',
                   'credito' => 'required|max:20',
                   'lance' => 'max:20',
                  // 'pressa' => 'required',
               ],$messages);

                if ($validator->fails()) {
                   return redirect()->route('landing_page')
                               ->withErrors($validator)
                               ->withInput();
               }

               //Se chegou até aqui é pq o usuario é novo. Cria o usuario
               $user = new User();
               $user->email = $request->email;
               $user->name = $request->nome;

               $exp = array_values( explode(" ", $request->nome) );
               $pass = array_shift( $exp ) ;
               $pass = strtolower( $pass )."_youcons";

               $user->password = Hash::make($pass);
               $user->telefone = $request->telefone;

               try {

                   if($user->save())
                       $user->addInteracao('criou-conta'); //adiciona a interação

                   $user->addRole('cliente'); //adiciona a role cliente

                   //cria a simulação nova
                   $simulacao = new Simulacao();
                   $simulacao->modalidade_id = $request->modalidade;

              /*
                   $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
                   $curr = "USD";
                   $credito = $formatter->parseCurrency($request->credito, $curr);
                   $parcela = $formatter->parseCurrency($request->parcela, $curr);
                   $lance = $formatter->parseCurrency($request->lance, $curr);

                   echo $credito;exit;*/

                   $simulacao->credito = str_replace(',', '.', $request->credito);
                   $simulacao->lance = str_replace(',', '.', $request->lance);
                   //$simulacao->pressa = $request->pressa;
                   $simulacao->save();

                   $simulacao->cliente()->associate($user); //adiciona o usuario criado anteriormente

                   if( $simulacao->save() )
                       $user->addInteracao('1a-simulacao-site'); //adiciona a interação

                   $data = [
                       'show_modal' => 1,
                       'modal_view' => 'modal.home_form_success'
                   ];

                   return redirect()->route('landing_page')->with($data);

               } catch (Exception $e) {

                    $data = [
                       'show_modal' => 1,
                       'modal_view' => 'modal.home_form_error'
                   ];

                   return redirect()->route('landing_page')->with($data);

               }
           //
       }

        return view('landing', array('form' => $form) );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function nao_autorizado()
    {
        return view('nao-autorizado');
    }

    public function teste_email(Request $request)
    {
        DB::table('indicacoes')->truncate();

        $indicacao = new Indicacao;
        $indicacao->email = $request->query('email');
        $indicacao->user_id = 54;
        $indicacao->key = encrypt( $request->input('email') );

        if($indicacao->save())
        {
           /* if( $request->query('fila',false) )
                //insere na fila
                IndicacaoEmailJob::dispatch( $request->query('email'), 54, $indicacao->id )->onQueue('emails');
            else                */
                //envia diretamente
                Mail::to($request->query('email'))->queue( new IndicacaoCreated($request->query('email'), 54, $indicacao->id) );   

            echo "ok";
        }
    }

    //envia email de contato
    public function contato(Request $request)
    {
        $data = [
            'nome' =>$request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone','Não informado'),
            'mensagem' => $request->input('mensagem','')
        ];     

        Mail::to('vendas@youcons.com.br')->queue( new Contato($data) ); 
        
        $data = [
            'show_modal' => 1,
            'modal_view' => 'modal.home_contato'
        ];
        return redirect()->route('home')->with($data);  
    }


    public function simulacao(Request $request)
    {
        //print_r($request->all());exit; 
        $messages = [
            'modalidade.required' => 'Por favor, selecione uma modalidade!',
            'email.unique' => 'Este email já foi utilizado! Utilize a área de clientes para acessar sua conta.'           
        ];
        
        //validações

        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:60',
            'email' => 'required|unique:users,email|email|max:50', //unique:users,email
            'telefone' => 'required|max:50',
            'modalidade' => 'required',
            'credito' => 'required|max:20',
            'parcela' => 'required|max:20',
            'lance' => 'required|max:20',
           // 'pressa' => 'required',
        ],$messages);
        
         if ($validator->fails()) {
            return redirect()->route('home')
                        ->withErrors($validator)
                        ->withInput();
        }

        //Se chegou até aqui é pq o usuario é novo. Cria o usuario
        $user = new User();   
        $user->email = $request->email; 
        $user->name = $request->nome;         
        
        $exp = array_values( explode(" ", $request->nome) );
        $pass = array_shift( $exp ) ;      
        $pass = strtolower( $pass )."_youcons";   

        $user->password = Hash::make($pass); 
        $user->telefone = $request->telefone;

        try {

            if($user->save())
                $user->addInteracao('criou-conta'); //adiciona a interação

            $user->addRole('cliente'); //adiciona a role cliente            

            //cria a simulação nova
            $simulacao = new Simulacao();        
            $simulacao->modalidade_id = $request->modalidade;    

/*
            $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            $curr = "USD";
            $credito = $formatter->parseCurrency($request->credito, $curr);  
            $parcela = $formatter->parseCurrency($request->parcela, $curr);     
            $lance = $formatter->parseCurrency($request->lance, $curr);   

            echo $credito;exit;*/

            $simulacao->credito = str_replace(',', '.', $request->credito); 
            $simulacao->lance = str_replace(',', '.', $request->lance); 
            $simulacao->parcela = str_replace(',', '.', $request->parcela); 
            //$simulacao->pressa = $request->pressa; 
            $simulacao->save();

            $simulacao->cliente()->associate($user); //adiciona o usuario criado anteriormente

            if( $simulacao->save() )
                $user->addInteracao('1a-simulacao-site'); //adiciona a interação
            
            //envia email de boas vindas            
            Mail::to($user->email)->queue( new UserCreated($user, $pass) );   

            $data = [
                'show_modal' => 1,
                'modal_view' => 'modal.home_form_success'
            ];

            return redirect()->route('home')->with($data);

        } catch (Exception $e) {
           
             $data = [
                'show_modal' => 1,
                'modal_view' => 'modal.home_form_error'
            ];

            return redirect()->route('home')->with($data);

        }       
    }

    //
    //verifica a indicação e mostra a página com o form
    public function indicacao(Request $request, FormBuilder $formBuilder)
    {
        $ind = $request->query('ind');        
        $key = $request->query('key');        

        $indicacao = Indicacao::where([
            ['id',$ind],
            ['key',$key],
            ['active',1]
        ])->first();

        $msg = 'erro';

        //se a indicação existe (id+key corretos)
        if($indicacao)
        {
            $form = $formBuilder->create('App\Forms\IndicacaoForm', [
                'method' => 'POST',
                'url' => route('indicacao_save')            
            ],[ 'indicacao_id' => $ind ]);
            $msg = 'success';
        }

        return view('indicacao', compact('form') )->with('msg',$msg);
    }

    //salva, cria usuario, redireciona
    public function indicacao_save(Request $request)
    {
        $messages = ['password.confirmed' => 'A confirmação de senha não coincide com a senha original! Por favor, insira os mesmos valores.'];

        $validator = $request->validate([
            'nome' => 'required|max:60',
            'password' => 'confirmed:password_confirmation'                      
        ],$messages);                   

        $indicacao = Indicacao::find( $request->input('id') );
        //cria o novo usuario e atualiza a entrada da indicação

        $user = new User();
        $user->email = $indicacao->email;
        $user->name = $request->input('nome');  
        $user->indicacao = 1;  
        $user->password = Hash::make( $request->input('password') );        

        if($user->save())
        {           
            $user->addRole('cliente');

            $indicacao->active = 0;
            $indicacao->indicado_id = $user->id;
            $indicacao->save();

            //insere uma interação nova pro usuario que indicou
            $quem_indicou = User::find($indicacao->user_id);
            $quem_indicou->addInteracao('indicacao-cadastro');

            Auth::login($user);
            return redirect()->route('login');
        }

    }


}
