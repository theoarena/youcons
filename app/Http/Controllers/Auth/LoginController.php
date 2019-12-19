<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login'; 
    // reenvia para a mesma tela pois o middleware guest redireciona 
    //de acordo com o tipo de usuario

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');        
    }


    /**
     * Login user and create token
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

       if ($request->remember_me)
           $token->expires_at = Carbon::now()->addWeeks(4);

       $token->save();

        return redirect()->intended('login');

       return response()->json([
              'access_token' => $tokenResult->accessToken,
              'token_type' => 'Bearer',
              'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
       ]);
    }

    public function logout($request)
    {
        Auth::logout();
        $request->user()->token()->revoke();
        return redirect('/home');
    }
}
