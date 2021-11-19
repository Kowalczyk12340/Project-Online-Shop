<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdminCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {surname} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created admin';

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
     * @return int
     */
    public function handle()
    {
        $user = new User();
        $user->name = $this->argument('name');
        $user->surname = $this->argument('surname');
        $user->email = $this->argument('email');
        $user->password = Hash::make($this->argument('password'));
        $user->assignRole('admin');
        $user->save();

        $this->info('Admin created successfuly');
        
    }
}
