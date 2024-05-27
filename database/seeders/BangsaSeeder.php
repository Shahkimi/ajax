<?php

namespace Database\Seeders;

use App\Models\Bangsa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer;



class BangsaSeeder extends Seeder
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
                'nama_bangsa' => 'Melayu',
                'desc_bangsa' => 'Description of Melayu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Cina',
                'desc_bangsa' => 'Description of Cina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'India',
                'desc_bangsa' => 'Description of India',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Bumiputera Sabah',
                'desc_bangsa' => 'Description of Bumiputera Sabah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Bumiputera Sarawak',
                'desc_bangsa' => 'Description of Bumiputera Sarawak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Orang Asli(Semenanjung)',
                'desc_bangsa' => 'Description of Orang Asli',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Tiada',
                'desc_bangsa' => 'Description of Tiada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_bangsa' => 'Dan lain-lain',
                'desc_bangsa' => 'Description of Dan lain-lain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the bangsas table
        DB::table('bangsas')->insert($data);
    }
}
