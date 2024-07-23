<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elzata',
                'slug' => 'elzata',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Brand::insert($data);
    }
}
