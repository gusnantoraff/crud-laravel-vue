<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'user:make-admin {userId}';
    protected $description = 'Make a user an admin';

    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::findOrFail($userId);
        $user->role = 'admin';
        $user->save();

        $this->info('User role updated to admin');
    }
}