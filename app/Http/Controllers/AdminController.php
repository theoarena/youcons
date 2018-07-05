<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {       	
        return view('admin.home', ['pageTitle' => 'Dashboard', 'apiUrl' => route('api_getusers', ['tipo' =>'inativos']) ] );
    }    

}
