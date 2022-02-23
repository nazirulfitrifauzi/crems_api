<?php

namespace Database\Seeders;

use App\Models\RefAccStatus;
use Illuminate\Database\Seeder;

class RefAccStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefAccStatus::insert([
            [
                'description'    => 'Active',
            ],
            [
                'description'    => 'Deactivated',
            ],
        ]);
    }
}
