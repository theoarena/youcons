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

class UserCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    protected $user;
    protected $pass;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$pass)
    {
         $this->user = $user;
         $this->pass = $pass;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /*Carbon::now()->addSeconds(30),*/ 
        Mail::to($this->user->email)->send( new UserCreated($this->user, $this->pass) );     
    }
}
