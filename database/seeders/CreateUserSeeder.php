<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
           
            [
                'name' => 'User2',
                'email' => 'kevin@user.com',
                'role' => '2',
                'password' => bcrypt('12345'),
            ]
            ];
            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
