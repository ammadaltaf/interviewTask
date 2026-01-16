<?php
// database/factories/OrderFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class OrderFactory extends Factory {
    protected $model = \App\Models\Order::class;

    public function definition(): array {
        $subtotal = $this->faker->randomFloat(2, 50, 500);
        $tax = $subtotal * 0.1;
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'assigned_staff_id' => User::whereHas('role', fn($q)=> $q->where('name','Staff'))->inRandomOrder()->first()->id,
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $subtotal + $tax,
        ];
    }
}