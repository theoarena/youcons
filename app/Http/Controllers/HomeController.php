<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator;
use App\User;
use App\Simulacao;
use App\Role;

use App\Jobs\UserCreatedEmail;
use App\Mail\UserCreated;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

        return view('home-site', compact('form') );
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
            Mail::to($user->email)->send( new UserCreated($user, $pass) );   
            //UserCreatedEmail::dispatch($user,$pass)->onQueue('emails');

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

}