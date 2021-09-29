<?php

namespace Database\Seeders;

use App\Models\SteppingStone;
use Illuminate\Database\Seeder;

class SteppingStoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SteppingStone::factory()->count(5)->create();
    }
}
