<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $editor = User::factory()->create([
            'name' => 'Editor Toko',
            'email' => 'editor@example.com',
            'role' => 'editor',
        ]);

        $user = User::factory()->create([
            'name' => 'Pelanggan Satu',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

        $customers = User::factory()->count(7)->create()->push($user);

        foreach (['Elektronik', 'Fashion', 'Rumah Tangga', 'Olahraga', 'Buku', 'Kesehatan'] as $name) {
            Category::factory()->named($name)->create();
        }

        $tags = collect(['Terlaris', 'Promo', 'Baru', 'Garansi Resmi', 'Gratis Ongkir', 'Stok Terbatas', 'Pilihan Editor', 'Impor'])
            ->map(fn (string $name) => Tag::create(['name' => $name]));

        $products = Product::factory()->count(60)->create();

        foreach ($products as $product) {
            $product->tags()->attach(
                $tags->random(random_int(1, 3))->pluck('id')->all(),
                ['created_by' => $admin->id]
            );
        }

        $available = $products->where('is_active', true)->values();

        foreach ($customers as $customer) {
            for ($i = 0; $i < random_int(1, 3); $i++) {
                $order = Order::factory()->for($customer)->create();

                foreach ($available->random(random_int(1, 4)) as $product) {
                    $order->items()->create([
                        'product_id' => $product->id,
                        'qty' => random_int(1, 3),
                        'price' => $product->price,
                    ]);
                }
            }
        }

        Post::factory()->count(4)->for($admin)->create();
        Post::factory()->count(4)->for($editor)->create();
        Post::factory()->count(4)->for($user)->create();
        Post::factory()->count(3)->for($customers->first())->create();
    }
}
