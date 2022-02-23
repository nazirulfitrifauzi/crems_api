<?php

namespace Database\Seeders;

use App\Models\RefRole;
use Illuminate\Database\Seeder;

class RefRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefRole::insert([
            [
                'description'    => 'System Admin',
            ],
            [
                'description'    => 'Administrator',
            ],
            [
                'description'    => 'Staff',
            ],
        ]);
    }
}
