<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Jobs\UserCreatedEmail;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'email.unique' => 'Este email já está sendo utilizado!',
            'password.confirmed' => 'A confirmação de senha está errada! Verifique e insira a mesma senha nos dois campos.'           
        ];

        return Validator::make($data, [
            'name' => 'required|string|max:60',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $pass = $data['password'];

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($pass),
        ]);

        $user->addRole('cliente'); //adiciona a role padrão CLIENTE

        //envia email de boas vindas
        Mail::to($user->email)->queue( new UserCreated($user, $pass) );         
        //UserCreatedEmail::dispatch($user,$pass); 

        return $user;

    }
}
