<?php

namespace Database\Seeders;

use App\Models\Gelaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GelaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        // Generate 20 records
        for ($i = 1; $i <= 25; $i++) {
            $data[] = [
                'nama_gelaran' => 'Gelaran ' . $i,
                'desc_gelaran' => 'Description of Gelaran ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the agama table
        DB::table('gelarans')->insert($data);
    }
}
