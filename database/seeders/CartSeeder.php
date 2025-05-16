<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cart; // Ensure you import the Cart model

class CartSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the carts table
        Cart::create([
            'customer_id' => 7,
            'product_id' => 8, // Assuming product_id 1 exists in the products table
            'qty' => 2,
            'price' => 12222.00,
            'total' => 24444.00
        ]);
        
        Cart::create([
            'customer_id' => 7,
            'product_id' => 5, // Assuming product_id 2 exists in the products table
            'qty' => 3,
            'price' => 12.00,
            'total' => 36.00
        ]);
        
        Cart::create([
            'customer_id' => 7,
            'product_id' => 10, // Assuming product_id 3 exists in the products table
            'qty' => 1,
            'price' => 12.00,
            'total' => 24.00
        ]);
    }
}

