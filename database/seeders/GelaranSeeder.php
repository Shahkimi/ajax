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
        // Define the data to be inserted
        $data = [
            [
                'nama_gelaran' => 'CIK',
                'desc_gelaran' => 'Description of Cik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'DATO',
                'desc_gelaran' => 'Description of Dato',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'DATIN',
                'desc_gelaran' => 'Description of Datin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'DR',
                'desc_gelaran' => 'Description of Dr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'ENCIK',
                'desc_gelaran' => 'Description of Encik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'HAJI',
                'desc_gelaran' => 'Description of Haji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'HAJAH',
                'desc_gelaran' => 'Description of Hajah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'PUAN',
                'desc_gelaran' => 'Description of Puan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'YB',
                'desc_gelaran' => 'Description of Yb',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_gelaran' => 'YM',
                'desc_gelaran' => 'Description of Yang Mulia',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        // Insert data into the gelarans table
        DB::table('gelarans')->insert($data);
    }
}
