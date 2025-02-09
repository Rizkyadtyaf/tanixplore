<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->count(50)->create();
        $owners = User::where('role', 'owner')->get(); // Ambil semua owner

        foreach ($owners as $owner) {
            Product::factory()
                ->count(20)
                ->create([
                    'user_id' => $owner->id, // Hubungkan produk ke owner
                ]);
        }
    }
}
