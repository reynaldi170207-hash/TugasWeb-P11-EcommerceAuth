<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static int $cursor = 0;

    public const CATALOG = [
        ['Elektronik', 'Smartphone Samsung Galaxy A55 8/256GB', 5499000],
        ['Elektronik', 'Smartphone Xiaomi Redmi Note 13 Pro', 3899000],
        ['Elektronik', 'Laptop ASUS Vivobook 14 Ryzen 5', 8299000],
        ['Elektronik', 'Laptop Lenovo IdeaPad Slim 3 Core i5', 7999000],
        ['Elektronik', 'Earbuds TWS Anker Soundcore P30i', 449000],
        ['Elektronik', 'Headphone Sony WH-CH520 Wireless', 699000],
        ['Elektronik', 'Smartwatch Amazfit Bip 5', 899000],
        ['Elektronik', 'Power Bank Baseus 20000mAh 65W', 599000],
        ['Elektronik', 'Mouse Logitech M331 Silent Wireless', 229000],
        ['Elektronik', 'Keyboard Mekanikal Keychron K2 V2', 1299000],
        ['Elektronik', 'Monitor LG UltraGear 24 inch 144Hz', 2199000],
        ['Elektronik', 'Speaker Bluetooth JBL Flip 6', 1799000],
        ['Fashion', 'Kemeja Flanel Pria Lengan Panjang', 189000],
        ['Fashion', 'Kaos Polos Cotton Combed 30s Unisex', 69000],
        ['Fashion', 'Celana Chino Slim Fit Pria', 229000],
        ['Fashion', 'Jaket Hoodie Fleece Unisex', 259000],
        ['Fashion', 'Gamis Syari Premium Wolfis', 329000],
        ['Fashion', 'Hijab Segi Empat Voal Ultrafine', 55000],
        ['Fashion', 'Sepatu Sneakers Ventela Public Low', 369000],
        ['Fashion', 'Sandal Jepit Swallow Premium', 29000],
        ['Fashion', 'Tas Ransel Laptop Waterproof 15 inch', 249000],
        ['Fashion', 'Topi Baseball Polos Adjustable', 45000],
        ['Rumah Tangga', 'Rice Cooker Miyako 1.8 Liter', 389000],
        ['Rumah Tangga', 'Blender Philips HR2221 Plastik 2L', 549000],
        ['Rumah Tangga', 'Setrika Uap Philips GC1905', 349000],
        ['Rumah Tangga', 'Panci Set Stainless Maxim 5 Pcs', 479000],
        ['Rumah Tangga', 'Kipas Angin Berdiri Cosmos 16 inch', 329000],
        ['Rumah Tangga', 'Dispenser Air Sanken Hot and Normal', 689000],
        ['Rumah Tangga', 'Sprei Katun Jepang King Size', 275000],
        ['Rumah Tangga', 'Lampu LED Philips 14W Paket Isi 4', 119000],
        ['Rumah Tangga', 'Rak Sepatu Susun 4 Tingkat', 149000],
        ['Rumah Tangga', 'Vacuum Cleaner Sharp EC-NS18', 799000],
        ['Olahraga', 'Matras Yoga TPE 6mm Anti Slip', 119000],
        ['Olahraga', 'Dumbbell Vinyl Set 10 Kg', 259000],
        ['Olahraga', 'Raket Badminton Yonex Astrox 01 Clear', 849000],
        ['Olahraga', 'Sepatu Lari Specs Lightspeed', 599000],
        ['Olahraga', 'Bola Sepak Adidas Tiro Club No.5', 289000],
        ['Olahraga', 'Sepeda Statis Lipat Magnetic', 1499000],
        ['Olahraga', 'Botol Minum Tupperware Eco 750ml', 99000],
        ['Olahraga', 'Skipping Rope Speed Bearing', 59000],
        ['Olahraga', 'Jersey Futsal Printing Custom', 135000],
        ['Olahraga', 'Resistance Band Set 5 Level', 89000],
        ['Buku', 'Laravel Up and Running Edisi 4', 549000],
        ['Buku', 'Clean Code Robert C. Martin', 289000],
        ['Buku', 'Atomic Habits Bahasa Indonesia', 99000],
        ['Buku', 'Filosofi Teras Henry Manampiring', 85000],
        ['Buku', 'Laskar Pelangi Andrea Hirata', 79000],
        ['Buku', 'Belajar Pemrograman PHP dan MySQL', 115000],
        ['Buku', 'Rich Dad Poor Dad Edisi Terjemahan', 89000],
        ['Buku', 'Bumi Manusia Pramoedya Ananta Toer', 119000],
        ['Kesehatan', 'Masker Medis 3 Ply Sensi Box 50 Pcs', 35000],
        ['Kesehatan', 'Vitamin C 1000mg Isi 30 Tablet', 65000],
        ['Kesehatan', 'Termometer Digital Omron MC-246', 79000],
        ['Kesehatan', 'Tensimeter Digital Omron HEM-7120', 649000],
        ['Kesehatan', 'Hand Sanitizer Dettol 500ml', 42000],
        ['Kesehatan', 'Minyak Kayu Putih Cap Lang 120ml', 38000],
        ['Kesehatan', 'Oximeter Fingertip Yuwell YX102', 189000],
        ['Kesehatan', 'Multivitamin Pria Centrum 60 Tablet', 215000],
        ['Kesehatan', 'Sunscreen Wardah UV Shield SPF 50', 62000],
    ];

    public function definition(): array
    {
        [$categoryName, $name, $price] = self::CATALOG[self::$cursor++ % count(self::CATALOG)];

        return [
            'category_id' => Category::where('name', $categoryName)->value('id') ?? Category::factory(),
            'user_id' => User::whereIn('role', ['admin', 'editor'])->inRandomOrder()->value('id') ?? User::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.Str::lower(Str::random(4)),
            'description' => fake()->paragraph(3),
            'price' => $price,
            'stock' => fake()->numberBetween(0, 150),
            'is_active' => fake()->boolean(95),
        ];
    }
}
