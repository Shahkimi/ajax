<?php

namespace Database\Seeders;

use App\Models\Gkcuti;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GcutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'kategori_cuti' => 'Cuti Perubatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_cuti' => 'Cuti Tanpa Rekod',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_cuti' => 'Cuti Perkhidmatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        // Insert data into the gelarans table
        DB::table('gkcutis')->insert($data);
    }
}
