<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Kachkaev\PHPR\RCore;
use Kachkaev\PHPR\Engine\CommandLineREngine;
use Illuminate\Support\Facades\Log;

use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AdminController extends Controller
{
       public function index()
       {
              return view('admin.home', ['pageTitle' => 'Dashboard', 'apiUrl' => route('api_getusers', ['tipo' =>'inativos']) ] );
       }

       function rprogram(){


//              ini_set('display_errors', 1);
//              ini_set('display_startup_errors', 1);
//              error_reporting(E_ALL);
//              $query = resource_path('r_filses/youc.R');


              $binary =   "C:/Program Files/R/R-3.5.1/bin/x64/R.exe";


              //$process = new Process(array($binary,"--slave", "--vanilla") );
              $process = new Process(array("echo","ssssssssssss") );

              $code = <<<EOF
              1+1
EOF;
            //  $process->setInput('php -i');
              $process->run();

              try {
                  $process->mustRun();

                  echo $process->getOutput();
              } catch (ProcessFailedException $exception) {
                  echo $exception->getMessage();
              }

              // executes after the command finishes
              if (!$process->isSuccessful()) {

                    // throw new ProcessFailedException($process);
                //  throw new RuntimeException($process);
              }

              echo $process->getOutput();
              $process->stop();

             /* $r_core = new RCore(new CommandLineREngine($exec));
              $rProcess = $r_core->createInteractiveProcess();

              Log::debug('r-php', ["vai entrar==========="]);
              $rProcess->start();
              try{
//                     $rProcess->write('
//                            cr = 5000
//                            la = 1000
//                            li = 1000
//                     ');
                     $rProcess->write('
                           x = 1
                            y = 2
                            x + y
                     ');

                     $rProcess->getAllResult();
              }
              catch (Exception $e){
                     Log::debug('r-php', "erro");
              }
              Log::debug('r-php', ["saiu==========="]);
              echo $rProcess->getErrorCount();exit;



              $errors = $rProcess->getLastWriteErrors();
              echo $errors[0]->getErrorMessage();*/

              //$rProcess->write($query);

              //       echo $rProcess->getAllInput();
              //echo $rProcess->getAllResult();
              exit;
              //return response()->json( [ 'status'=>'ok' ] );

       }

}
