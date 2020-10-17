<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        // Hard code a few to make login easier during testing.
        $this->hardCodeUser('user1');
        $this->hardCodeUser('user2');
        $this->hardCodeUser('user3');
        $this->hardCodeUser('user4');
    }

    /**
     * Create a user record with given name as the
     * name and email.
     */
    private function hardCodeUser(string $name)
    {
        User::create([
            'name' => $name,
            'email' => $name . '@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
