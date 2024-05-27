<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgamaSeeder extends Seeder
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
                'nama_agama' => 'Islam',
                'desc_agama' => 'Description of Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Buddha',
                'desc_agama' => 'Description of Buddha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Hindu',
                'desc_agama' => 'Description of Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Konfusianisma',
                'desc_agama' => 'Description of Konfusianisma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Bahai',
                'desc_agama' => 'Description of Bahai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Puak / Suku',
                'desc_agama' => 'Description of Puak / Suku',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Kristian',
                'desc_agama' => 'Description of Kristian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Sikhism',
                'desc_agama' => 'Description of Sikhism',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Tao',
                'desc_agama' => 'Description of Tao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Tiada Agama',
                'desc_agama' => 'Description of Tiada Agama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_agama' => 'Dan lain-lain',
                'desc_agama' => 'Description of lain-lain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the agamas table
        DB::table('agamas')->insert($data);
    }
}
