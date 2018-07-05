<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\User;
use App\Simulacao;
use App\Vendedor;

use Illuminate\Database\Eloquent\Model;

class AdminSimulacaoController extends Controller
{	

    public function index()
    {         
        return view('admin.simulacoes', ['pageTitle' => 'Simulações', 'apiUrl' => route('api_getsimulacoes')] ); 
    }

    public function show(Int $id = null,FormBuilder $formBuilder)
    {
  		$simulacao = Simulacao::find($id); 		    

        $form = $formBuilder->create('App\Forms\AdminSimulacaoForm', [
            'method' => 'POST',
            'model' => $simulacao,
            'url' => route('admin_simulacoes.save')            
        ]);

        return view('admin.simulacoes-edit', ['pageTitle' => 'Simulações', "obj" => $simulacao, 'form' => $form] );
    }

    public function save(Request $request) //cria ou atualiza o cliente
    {
        $simu = Simulacao::find($request->id);
        $vendedor = Vendedor::find($request->vendedores);  

        $vendedor->simulacoes()->save($simu);          
       // $simu->save();        

        return redirect()->route('admin_simulacoes')->with( ['message' => 'User saved successfully!', 'type' => 'success'] );

    }
   

}
