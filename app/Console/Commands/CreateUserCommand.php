<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A new User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // Just to test eyi k3k3
        $user['name'] = $this->ask(question: 'Name of User');

        User::create($user);
    }
}
