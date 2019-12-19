<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/simulacao', 'HomeController@landing_page')->name('landing_page');


Route::get('/teste-email', 'HomeController@teste_email')->name('teste_email');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/simulacao', 'HomeController@simulacao')->name('simulacao_home');
Route::post('/home/contato', 'HomeController@contato')->name('contato_home');


Route::get('/indicacao', 'HomeController@indicacao')->name('indicacao');
Route::post('/indicacao-save', 'HomeController@indicacao_save')->name('indicacao_save');
Route::get('/nao-autorizado', 'HomeController@nao_autorizado')->name('nao_autorizado');
//Admin
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    
	Route::get('/', 'AdminController@index')->name('admin');

	Route::get('/clientes', 'AdminClientesController@index')->name('admin_clientes');
	Route::get('/clientes/new', 'AdminClientesController@show')->name('admin_clientes.new');
	Route::get('/clientes/edit/{id?}', 'AdminClientesController@show')->name('admin_clientes.edit');
	Route::post('/clientes/save/{id?}', 'AdminClientesController@save')->name('admin_clientes.save');
	Route::delete('/clientes/delete/{id?}', 'AdminClientesController@delete')->name('admin_clientes.delete');

	Route::get('/vendedores', 'AdminVendedoresController@index')->name('admin_vendedores');
	Route::get('/vendedores/new', 'AdminVendedoresController@show')->name('admin_vendedores.new');
	Route::get('/vendedores/edit/{id?}', 'AdminVendedoresController@show')->name('admin_vendedores.edit');
	Route::post('/vendedores/save/{id?}', 'AdminVendedoresController@save')->name('admin_vendedores.save');
	Route::delete('/vendedores/delete/{id?}', 'AdminVendedoresController@delete')->name('admin_vendedores.delete');
   
	Route::get('/vouchers', 'AdminVouchersController@index')->name('admin_vouchers');
	Route::get('/vouchers/new', 'AdminVouchersController@show')->name('admin_vouchers.new');
	Route::get('/vouchers/edit/{id?}', 'AdminVouchersController@show')->name('admin_vouchers.edit');
	Route::post('/vouchers/save/{id?}', 'AdminVouchersController@save')->name('admin_vouchers.save');
	Route::delete('/vouchers/delete/{id?}', 'AdminVouchersController@delete')->name('admin_vouchers.delete');

	Route::get('/simulacoes', 'AdminSimulacaoController@index')->name('admin_simulacoes');
	Route::get('/simulacoes/new', 'AdminSimulacaoController@show')->name('admin_simulacoes.new');
	Route::get('/simulacoes/edit/{id?}', 'AdminSimulacaoController@show')->name('admin_simulacoes.edit');
	Route::post('/simulacoes/save/{id?}', 'AdminSimulacaoController@save')->name('admin_simulacoes.save');
	Route::delete('/simulacoes/delete/{id?}', 'AdminSimulacaoController@delete')->name('admin_simulacoes.delete');

	//Route::get('/users/new', 'AdminUsersController@show')->name('admin_users.new');	

	Route::post('/users/save/{id?}', 'AdminUserController@save')->name('admin_users.save');
	Route::delete('/users/delete/{id?}', 'AdminUserController@delete')->name('admin_users.delete');

	Route::get('/perfil', 'AdminController@profile')->name('admin_perfil');

	Route::get('/rprogram', 'AdminController@rprogram')->name('admin.r');

});

//clientes 
Route::middleware(['auth'])->prefix('clientes')->group(function () {

        Route::get('/', 'ClienteController@index')->name('clientes');
        Route::get('/perfil', 'ClienteController@profile')->name('clientes_perfil');
        Route::get('/ovos-de-ouro', 'ClienteController@pontos')->name('clientes_pontos');
        Route::post('/perfil/save', 'ClienteController@save')->name('clientes_profile.save');
        Route::post('/perfil/save-picture', 'ClienteController@save_picture')->name('clientes_profile_picture.save');

        Route::get('/bem-vindo', 'ClienteController@bem_vindo')->name('clientes_bem-vindo');
        Route::post('/indicar-amigo', 'ClienteController@indicar_amigo')->name('clientes_indicar-amigo');

        //Route::get('/simulacoes', 'ClienteSimulacoesController@index')->name('clientes_simulacoes');
      //  Route::get('/simulacoes/new', 'ClienteSimulacoesController@new')->name('clientes_simulacoes.new');
       // Route::get('/simulacoes/edit/{id?}', 'ClienteSimulacoesController@edit')->name('clientes_simulacoes.edit');
    //    Route::post('/simulacoes/save', 'ClienteSimulacoesController@save')->name('clientes_simulacoes.save');

        Route::get('/simulacoes/nova-simulacao', 'ClienteSimulacoesController@nova_simulacao')->name('clientes_simulacoes.nova-simulacao');

});

Auth::routes();

//Route::group( ['prefix' => 'auth'], function () {
//
//  //  Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login')->name('login');
//    Route::post('/signup', '\App\Http\Controllers\Auth\LoginController@signup')->name('signup');
//    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
//
//});




//facebook login routes
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

//Route::redirect('/home', '/simulacao');
//Route::redirect('/', '/simulacao');