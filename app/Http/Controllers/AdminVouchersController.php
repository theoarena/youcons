<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

use App\Voucher;

use Illuminate\Database\Eloquent\Model;

class AdminVouchersController extends Controller
{
    public function index()
    {        
        return view('admin.vouchers', ['pageTitle' => 'Vouchers', 'apiUrl' => route('api_getvouchers')] ); 
    }

    //mostra o form para edição e inserção de um novo
    public function show(Int $id = null,FormBuilder $formBuilder)
    {   
    	$user = null;

    	if($id != null)   	  		
  			$user = Voucher::find($id);  			

    	$form = $formBuilder->create('App\Forms\AdminVoucherForm', [
            'method' => 'POST',
            'url' => route('admin_vouchers.save'), //users
            'model' => $user
        ], [ 'redirect' => 'admin_vouchers' ] );

        return view('admin.vouchers-form', ['form' => $form , 'pageTitle' => 'Vouchers'] );
    }    

    public function save(Request $request) //cria ou atualiza o voucher
    {
        $voucher = new Voucher;

        if( $request->input('id',null) != null )
            $voucher = Voucher::find( $request->input('id') );

        $voucher->codigo =  $request->input('codigo');
        $voucher->experiencia =  $request->input('experiencia');
        $voucher->valid_until =  $request->input('valid_until');

        $voucher->save();                 

        return redirect()->route('admin_vouchers')->with( ['message' => 'Novo voucher criado', 'type' => 'success'] );

    }

    public function delete(Int $id)
    {  
        if(Voucher::destroy($id))         
           return response('removed', 200);
    }  
   
}