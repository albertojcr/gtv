<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CheckInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Desactiva usuarios inactivos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $users= User::inactiveUsers()->get();

        foreach ($users as $user){
            $this->info($user->login);
              $user->active=false;
              $user->save();
        }
    }
}
