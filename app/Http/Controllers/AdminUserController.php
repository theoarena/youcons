<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\User;
use App\Role;
use App\Vendedor;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
	var $default_pass = '#default#';

    public function index()
    {        
        return view('admin.user', ['pageTitle' => 'user', 'apiUrl' => route('api_getusers')] ); 
    }

    //mostra o forma para edição e inserção de um novo
    public function show(Int $id = null,FormBuilder $formBuilder)
    {   
    	$user = null;

    	if($id != null)   	
  		{ 
  			$user = User::find($id);
  			$user->password = $this->default_pass;  			
  		}

    	$form = $formBuilder->create('App\Forms\ClienteAdminForm', [
            'method' => 'POST',
            'url' => route('admin_user.save'),
            'model' => $user
        ]);


        return view('admin.user-form', ['form' => $form , 'pageTitle' => 'user'] );
    }

    public function save(Request $request) //cria ou atualiza o cliente
    {               
    	//print_r($request->roles);exit;

    	$date = date('Y-m-d');

        $user = new User;
        $role = Role::find($request->roles);

        //echo $role->name;exit;

        if($request->filled('id'))        
            $user = User::find( $request->input('id') );                
        
        $this->validate($request,[          
            'name' => 'required|max:60',
            'email' => [
                'required',  
                 Rule::unique('users')->ignore($user->id),
                 'email'
                ],
            'password' => 'required|max:10',    
        ]);

        $user->active = $request->input('active',0);   
        $user->name = $request->name;   
        $user->email   = $request->email;
        $user->telefone   = $request->telefone;

        if($request->password != $this->default_pass) //se mudou o password
    	    $user->password = Hash::make($request->password);           

        $user->save();

        $user->roles()->sync($request->roles);

        //=====================
        //=========== MELHORAR ESSA PARTE
        //=====================

        if($role->name == 'vendedor'){// caso seja vendedor                   
            $vendedor = Vendedor::where('user_id',$user->id)->first();           

            if(!$vendedor)
            {
                $vendedor = new Vendedor();
                $vendedor->conta()->associate($user);
                $vendedor->save();
            }
        }

        //====================

        return redirect()->route($request->redirect)->with( ['message' => 'User saved successfully!', 'type' => 'success'] );

    }

    public function delete(Int $id)
    {  
    	if(User::destroy($id))         
    	   return response('removed', 200);
    }   

   
}