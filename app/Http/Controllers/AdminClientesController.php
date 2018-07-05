<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class AdminClientesController extends AdminUserController
{	

    public function index()
    {        
        return view('admin.clientes', ['pageTitle' => 'Clientes', 'apiUrl' => route('api_getusers'), 'filter_ativo' => true] ); 
    }

    //mostra o form para edição e inserção de um novo
    public function show(Int $id = null,FormBuilder $formBuilder)
    {   
    	$user = null;

    	if($id != null)   	
  		{ 
  			$user = User::find($id);
  			$user->password = $this->default_pass;  			
  		}

    	$form = $formBuilder->create('App\Forms\AdminUserForm', [
            'method' => 'POST',
            'url' => route('admin_clientes.save'),
            'model' => $user
        ],[ 'redirect' => 'admin_clientes' ]);

        return view('admin.clientes-form', ['form' => $form , 'pageTitle' => 'Clientes'] );
    }
 
   
}