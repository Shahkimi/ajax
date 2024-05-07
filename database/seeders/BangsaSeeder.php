<?php

namespace Database\Seeders;

use App\Models\Bangsa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class BangsaSeeder extends Seeder
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
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'nama_bangsa' => 'Bangsa ' . $i,
                'desc_bangsa' => 'Description of Bangsa ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the agama table
        DB::table('bangsas')->insert($data);
    }
}
