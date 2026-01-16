<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Create roles
        $adminRole = Role::firstOrCreate(['name'=>'Admin']);
        $staffRole = Role::firstOrCreate(['name'=>'Staff']);

        // Users
        User::factory()->count(3)->create(['role_id'=>$adminRole->id]);
        User::factory()->count(5)->create(['role_id'=>$staffRole->id]);

        // Products
        $products = Product::factory()->count(10)->create();

        // Orders
        $orders = Order::factory()->count(5)->create();

        // Attach products to orders
        foreach($orders as $order){
            $selectedProducts = $products->random(3);
            foreach($selectedProducts as $product){
                $quantity = rand(1,3);
                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$product->id,
                    'quantity'=>$quantity,
                    'price'=>$product->price
                ]);
            }
        }
    }
}