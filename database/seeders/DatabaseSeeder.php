<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@store.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Test User
        User::create([
            'name'     => 'John Doe',
            'email'    => 'user@store.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Categories
        $categories = ['Electronics', 'Clothing', 'Home & Garden', 'Sports', 'Books'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat, 'slug' => Str::slug($cat)]);
        }

        // Products
        $products = [
            ['name' => 'Wireless Headphones', 'price' => 89.99, 'stock' => 50, 'category_id' => 1],
            ['name' => 'Smartphone Case',     'price' => 19.99, 'stock' => 100, 'category_id' => 1],
            ['name' => 'Laptop Stand',        'price' => 45.00, 'stock' => 30, 'category_id' => 1],
            ['name' => 'Men\'s T-Shirt',      'price' => 24.99, 'stock' => 200, 'category_id' => 2],
            ['name' => 'Running Shoes',       'price' => 119.99, 'stock' => 40, 'category_id' => 5],
            ['name' => 'Coffee Maker',        'price' => 79.99, 'stock' => 25, 'category_id' => 3],
            ['name' => 'Yoga Mat',            'price' => 34.99, 'stock' => 60, 'category_id' => 4],
            ['name' => 'Programming Book',   'price' => 39.99, 'stock' => 80, 'category_id' => 5],
        ];

        foreach ($products as $p) {
            Product::create(array_merge($p, [
                'slug'        => Str::slug($p['name']) . '-' . uniqid(),
                'description' => 'High quality ' . $p['name'] . '. Great value for money.',
                'is_active'   => true,
            ]));
        }
    }
}