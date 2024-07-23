<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kulit',
                'slug' => 'kulit',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plastik',
                'slug' => 'plastik',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Material::insert($data);
    }
}
