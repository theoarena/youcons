<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;

use Validator;
use App\User;
use App\Simulacao;

class ClienteSimulacoesController extends Controller
{	

    public function index()
    {
        return view('clientes.simulacoes', ["pageTitle" => "Minhas simulações"] );        
    }   

    public function nova_simulacao()
    {
        return view('clientes.simulacao-app');                
    }

    public function edit(Int $id = null)
    {
        $simulacao = Simulacao::find($id);                

        return view('clientes.simulacoes-edit', ['pageTitle' => 'Simulação', "obj" => $simulacao] );
    }

    public function new(FormBuilder $formBuilder)
    {   
      	$form = $formBuilder->create('App\Forms\ClienteSimulacaoForm', [
            'method' => 'POST',
            'url' => route('clientes_simulacoes.save'),
            'model' => Auth::user()
        ]);

        return view('clientes.simulacoes-form', ['form' => $form, "pageTitle" => "Solicitar nova simulação"] );   
    }

    //não está mais sendo usado, tudo é feito por API
    public function save(Request $request)
    {

        $messages = ['modalidade.required' => 'Por favor, selecione uma modalidade!'];

        $validator = Validator::make($request->all(), [               
            'modalidade' => 'required',
            'credito' => 'required|max:20',
            'parcela' => 'required|max:20',
            'lance' => 'required|max:20',
            'pressa' => 'required',
        ],$messages);
        
         if ($validator->fails()) {
            return redirect()->route('clientes_simulacoes.new')
                        ->withErrors($validator)
                        ->withInput();
        }        

        $user = Auth::user();        
        try {           

            //cria a simulação nova
            $simulacao = new Simulacao();        
            $simulacao->modalidade_id = $request->modalidade; //substituir pelo model    
            $simulacao->credito = $request->credito; 
            $simulacao->lance = $request->lance; 
            $simulacao->parcela = $request->parcela; 
            $simulacao->pressa = $request->pressa; 
            $simulacao->save();

            $simulacao->cliente()->associate($user); //adiciona o usuario criado anteriormente

            $simulacao->save();

            $data = [                
            	'type' => 'success',
                'message' => 'Simulação Solicitada com sucesso!'
            ];

            return redirect()->route('clientes')->with($data);

        } catch (Exception $e) {


            $data = [       
            	'type' => 'error',         
                'message' => 'Ocorreu algum erro, por favor tente novamente!'
            ];
            return redirect()->route('clientes')->with($data);
        }       
    }
}
