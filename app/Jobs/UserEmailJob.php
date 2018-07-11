<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use Illuminate\Support\Carbon;

class UserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $user;
    protected $tipo;
    protected $pass;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$tipo = null,$pass = null)
    {
         $this->user = $user;
         $this->tipo = $tipo;
         $this->pass = $pass;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->tipo) {
            case 'user-created-welcome':                
                Mail::to($this->user->email)->send( new UserCreated($this->user, $this->pass) );     
            break;            

            default: break;
        }
        /*Carbon::now()->addSeconds(30),*/ 
    }
}
