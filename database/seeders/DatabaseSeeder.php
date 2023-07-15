<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Voucher;
use App\Models\Cart;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'role' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'role' => 'superadmin'
        ]);
        $categories = ProductCategory::factory(5)->create();

        foreach ($categories as $cat) {
            $products = Product::factory(12)->create([
                'product_category_id' => $cat->id
            ]);
            $cat->products()->saveMany($products);
        }

        Voucher::insert([
            [
                'code' => 'wkwk',
                'quota' => 5,
                'discount' => 10000,
            ],
            [
                'code' => 'coba',
                'quota' => 5,
                'discount' => 5000
            ]
        ]);

        Cart::insert([
            [
                'user_id' => 1,
                'product_id' => 1,
                'quantity' => 1
            ],
            [
                'user_id' => 1,
                'product_id' => 2,
                'quantity' => 2
            ],
        ]);
    }
}
