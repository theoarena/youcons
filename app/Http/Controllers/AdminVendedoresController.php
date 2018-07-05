<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class AdminVendedoresController extends AdminUserController
{
    public function index()
    {        
        return view('admin.vendedores', ['pageTitle' => 'vendedores', 'apiUrl' => route('api_getusers', ['tipo' => 'vendedor'] ), 'filter_ativo' => true] ); 
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
            'url' => route('admin_users.save'), //users
            'model' => $user
        ], [ 'redirect' => 'admin_vendedores' ] );

        return view('admin.vendedores-form', ['form' => $form , 'pageTitle' => 'vendedores'] );
    }    
   
}