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

    public function nova_simulacao()
    {
        return view('clientes.simulacao-app');                
    }

  /*  public function edit(Int $id = null)
    {
        $simulacao = Simulacao::find($id);                

        return view('clientes.simulacoes-edit', ['pageTitle' => 'Simulação', "obj" => $simulacao] );
    }*/

  /*  public function new(FormBuilder $formBuilder)
    {   
      	$form = $formBuilder->create('App\Forms\ClienteSimulacaoForm', [
            'method' => 'POST',
            'url' => route('clientes_simulacoes.save'),
            'model' => Auth::user()
        ]);

        return view('clientes.simulacoes-form', ['form' => $form, "pageTitle" => "Solicitar nova simulação"] );   
    }*/

}
