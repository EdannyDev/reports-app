<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        Area::create(['name' => 'Mantenimiento']);
        Area::create(['name' => 'Sistemas']);
        Area::create(['name' => 'Finanzas']);
    }
}
