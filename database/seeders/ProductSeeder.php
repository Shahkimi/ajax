<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define an array to hold the dummy data
        $products = [];

        // Generate 1000 dummy products
        for ($i = 1; $i <= 1000; $i++) {
            $products[] = [
                'name' => 'Product ' . $i,
                'quantity' => rand(1, 100), // Random quantity between 1 and 100
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the dummy data into the database
        Product::insert($products);
    }
}
