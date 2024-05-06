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
        $data = [];

        // Generate 20 records
        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'nama_Agama' => 'Agama ' . $i,
                'desc_Agama' => 'Description of Agama ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data into the agama table
        DB::table('agama')->insert($data);
    }
}
