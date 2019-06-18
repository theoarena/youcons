<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Consorcio;

class ConsorcioController extends Controller
{

       public function new(Request $request)
       {

              $code = "ok";

              try{

                     /*TODO: formatar os valores com . e ,*/

                     $contratoEscolhido__administradora = $request->input('data.administradora');
                     $contratoEscolhido__simulacao = $request->input('data.simulacao');
                     $contratoEscolhido__parcela = $request->input('data.parcela');
                     $contratoEscolhido__prazo = $request->input('data.prazo');
                     $contratoEscolhido__credito = $request->input('data.credito');

                     $consorcio = new Consorcio();
                     $consorcio->administradora = $contratoEscolhido__administradora;
                     $consorcio->simulacao_id = $contratoEscolhido__simulacao;
                     $consorcio->parcela = $contratoEscolhido__parcela;
                     $consorcio->prazo = $contratoEscolhido__prazo;
                     $consorcio->credito = $contratoEscolhido__credito;

                     $consorcio->save();

              }
              catch (\Exception $e){

                     $code = "error";
              }

              return response()->json(
                  [
                      'status'=> $code
                  ]
              );

       }

}
