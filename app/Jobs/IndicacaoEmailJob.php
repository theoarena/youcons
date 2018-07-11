<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\IndicacaoCreated;
//use Illuminate\Support\Carbon;

class IndicacaoEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $user;
    protected $email;
    protected $indicacao;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$user,$indicacao)
    {
         $this->email = $email;        
         $this->user = $user;        
         $this->indicacao = $indicacao;        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*Carbon::now()->addSeconds(30),*/ 
        Mail::to($this->email)->send( new IndicacaoCreated($this->email, $this->user, $this->indicacao) );     
    }
}
