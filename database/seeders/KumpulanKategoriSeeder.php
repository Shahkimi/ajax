<?php

namespace Database\Seeders;

use App\Models\Gkategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class KumpulanKategoriSeeder extends Seeder
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
                'nama_kategori' => 'Sokongan 1',
                'desc_kategori' => 'Description of Sokongan 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Sokongan 2',
                'desc_kategori' => 'Description of Sokongan 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pengurusan Tertinggi',
                'desc_kategori' => 'Description of Pengurusan Tertinggi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Pengurusan Profesional',
                'desc_kategori' => 'Description of Pengurusan Profesional',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        // Insert data into the gelarans table
        DB::table('gkategoris')->insert($data);
    }
}
