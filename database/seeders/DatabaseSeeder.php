<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Boy Krijnen';
        $user->email = 'boy@sadcat.space';
        $user->email_verified_at = null;
        $user->password = '$2y$10$Sq0Mf0F62TBnusIe5YrX/e8YhYGFsW2z9XKzT1lNbwj3dvzq7H4mO';
        $user->remember_token = null;
        $user->created_at = '2023-10-26 14:04:59';
        $user->updated_at = '2023-10-26 14:04:59';
        $user->save();
    }
}
