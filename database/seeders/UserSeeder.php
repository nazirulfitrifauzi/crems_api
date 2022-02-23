<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([ //sys admin user
            [
                'name'                  => 'System Admin',
                'email'                 => 'admin@csc.net.my',
                'email_verified_at'     => now(),
                'password'              => Hash::make('Csc@1234'),
                'active'                => 1,
                'role'                  => 1,
                'created_at'            => now()
            ]
        ]);
    }
}
