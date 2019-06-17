<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;



use App\User;
use App\Indicacao;
use App\Jobs\IndicacaoEmailJob;
//use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/   

    public function index()
    {
        $user = Auth::user();          

        if($user->active == 0) //primeiro acesso
            return redirect()->route('clientes_bem-vindo');

        return view('clientes.simulacoes', ['apiUrl' => route('api_getsimulacoes', ['cliente' => $user->id ] ), "pageTitle" => "Minhas simulações"] );     

    }

    public function indicar_amigo( Request $request)
    {
        //verifica na tabela de indicação
        $exists = Indicacao::where('email',$request->input('email'))->count();
        $msg = "indicacao-error";       

        if($exists == 0)//se não existe
        {
            //verifica na tebela usuario
            $exists2 = User::where('email',$request->input('email'))->count();

            if($exists2 == 0)//se não existe
            {
                $secret = encrypt( ($request->input('email')."-".$request->input('user')) );

                $indicacao = new Indicacao;
                $indicacao->email = $request->input('email');
                $indicacao->user_id = $request->input('user');
                $indicacao->key = $secret;
                if($indicacao->save())
                {
                    Mail::to($request->input('email'))->queue( new IndicacaoCreated($request->input('email'), $request->input('user'), $indicacao->id) );  
                    //IndicacaoEmailJob::dispatch( $request->input('email'), $request->input('user'), $indicacao->id )->onQueue('emails');
                    $msg = "indicacao-success";
                }
            }
            else              
                $msg = 'indicacao-user-exists';
        }
        else
            $msg = 'indicacao-exists';

        return redirect()->back()->with('message-youcon', $msg);
    }

    public function bem_vindo()
    {
        $user = Auth::user();        
        return view('clientes.bem-vindo', ['cliente' => $user ] );   
    }

    public function pontos(FormBuilder $formBuilder, Request $request)
    {
        $user = Auth::user();   
        if (!$request->session()->has('message-youcon'))
            $request->session()->flash('message-youcon' , 'cliente-pontos');
        return view('clientes.pontos', ["pageTitle" => "Meus ovos de ouro", "user" => $user] );
    }


    public function profile(FormBuilder $formBuilder)
    {
        $user = Auth::user();

        $form = $formBuilder->create('App\Forms\ClienteProfileForm', [
            'method' => 'POST',
            'url' => route('clientes_profile.save'),
            'model' => $user
        ],[ 'birthday' => $user->birthday, 'password' => $user->password ]);

        $form_picture = $formBuilder->create('App\Forms\ClienteProfilePictureForm', [
            'method' => 'POST',
            'url' => route('clientes_profile_picture.save'),
            'model' => $user
        ]);

        return view('clientes.perfil', ['form' => $form, 'form_picture'=>$form_picture, "pageTitle" => "Minha conta", "user" => $user] );
    }
    

     /**
     * Save a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save_picture(Request $request) //atualiza a foto de perfil do usuario
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

         $user = Auth::user();

        //get filename with extension
        $filenamewithextension = $request->file('avatar')->getClientOriginalName();       
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);       
        $extension = $request->file('avatar')->getClientOriginalExtension();

        //filename to store
        $filenametostore = 'avatar_'.$user->id."_".time().'.'.$extension;

        //Upload File
        $request->file('avatar')->storeAs('public/avatars', $filenametostore);        

        //Resize image here
        $thumbnailpath = public_path('storage/avatars/'.$filenametostore);
        //echo $thumbnailpath;exit;

        $img = Image::make($thumbnailpath)->resize(300, 300 /*, function($constraint) { $constraint->aspectRatio(); }*/ );

        $img->save($thumbnailpath);

//        echo  public_path('storage/avatars/'.$user->avatar);exit;

        if($user->avatar != NULL)
            Storage::delete( public_path('storage/avatars/'.$user->avatar) ); //NAO ESTÁ DELETANDO

        $user->avatar = $filenametostore;
     
        $msg = "cliente-profile-error";

        if( $user->save() )
            $msg = "cliente-profile-picture-success"; 

        return redirect()->route('clientes_perfil')->with('message-youcon', $msg);

    }

    public function save(Request $request) //cria ou atualiza o cliente
    {               

     //   	print_r($request);exit;

    	$validatedData = $request->validate([
	        'name' => 'required|max:60',
            'email' => 'required|email',
            'cpf' => 'required|max:50',
	        'birthday' => 'required',
    	]);

    	$date = date('Y-m-d');

        if($request->filled('id'))
        {
        	$user = User::find( $request->input('id') );
            $user->updated_at = $date;
        }
        else
        {
            $user = new User;
            $user->created_at = $date;
        }

        $user->name = $request->name;   
        $user->email   = $request->email;
        $user->cpf   = $request->cpf;
        $user->birthday   = $request->birthday;

        if($request->password != config('constants.default_password') ) //se mudou o password
            if($request->password == $request->password_confirmation)
                $user->password = Hash::make($request->password);
          
        $msg = "cliente-profile-error";

        if( $user->save() )
            $msg = "cliente-profile-success";        

        return redirect()->route('clientes_perfil')->with('message-youcon', $msg);

    }

}
