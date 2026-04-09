<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 15 Pro Max', 'category' => 'Electronics', 'price' => 1199.00, 'original_price' => 1299.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'MacBook Pro 14"', 'category' => 'Electronics', 'price' => 1999.00, 'original_price' => 2199.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Samsung Galaxy S24 Ultra', 'category' => 'Electronics', 'price' => 1299.00, 'original_price' => 1399.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Nike Air Max 270', 'category' => 'Fashion', 'price' => 150.00, 'original_price' => 180.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Sony WH-1000XM5', 'category' => 'Electronics', 'price' => 349.00, 'original_price' => 399.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Apple Watch Ultra 2', 'category' => 'Electronics', 'price' => 799.00, 'original_price' => 899.00, 'is_featured' => true, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Levi\'s 501 Jeans', 'category' => 'Fashion', 'price' => 79.00, 'original_price' => 99.00, 'is_featured' => false, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
            ['name' => 'Dyson V15 Detect', 'category' => 'Home', 'price' => 749.00, 'original_price' => 799.00, 'is_featured' => false, 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5Hfdiw'],
        ];

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);
            Product::firstOrCreate(['slug' => $slug], $product);
        }
    }
}
