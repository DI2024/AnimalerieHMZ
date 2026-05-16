<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('No users or products found. Please seed users and products first.');
            return;
        }

        // Create 10 sample orders
        $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['pending', 'paid', 'failed'];
        $paymentMethods = ['card', 'paypal', 'bank_transfer', 'cash_on_delivery'];

        for ($i = 1; $i <= 10; $i++) {
            $user = $users->random();
            $status = $statuses[array_rand($statuses)];
            $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];
            
            // Calculate order totals
            $itemsCount = rand(1, 4);
            $subtotal = 0;
            $orderProducts = [];

            for ($j = 0; $j < $itemsCount; $j++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $price = $product->price;
                $itemSubtotal = $price * $quantity;
                
                $orderProducts[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $itemSubtotal,
                ];
                
                $subtotal += $itemSubtotal;
            }

            $shippingCost = $subtotal >= 100 ? 0 : 15;
            $tax = $subtotal * 0.20;
            $total = $subtotal + $shippingCost + $tax;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'shipping_first_name' => fake()->firstName(),
                'shipping_last_name' => fake()->lastName(),
                'shipping_email' => $user->email,
                'shipping_phone' => fake()->phoneNumber(),
                'shipping_address_line_1' => fake()->streetAddress(),
                'shipping_address_line_2' => rand(0, 1) ? fake()->secondaryAddress() : null,
                'shipping_city' => fake()->city(),
                'shipping_postal_code' => fake()->postcode(),
                'shipping_country' => 'France',
                'billing_first_name' => fake()->firstName(),
                'billing_last_name' => fake()->lastName(),
                'billing_address_line_1' => fake()->streetAddress(),
                'billing_address_line_2' => rand(0, 1) ? fake()->secondaryAddress() : null,
                'billing_city' => fake()->city(),
                'billing_postal_code' => fake()->postcode(),
                'billing_country' => 'France',
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_status' => $paymentStatus,
                'paid_at' => $paymentStatus === 'paid' ? now()->subDays(rand(0, 30)) : null,
                'status' => $status,
                'customer_notes' => rand(0, 1) ? fake()->sentence() : null,
                'admin_notes' => rand(0, 1) ? fake()->sentence() : null,
                'created_at' => now()->subDays(rand(0, 60)),
            ]);

            // Create order items
            foreach ($orderProducts as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'product_sku' => $item['product']->sku,
                    'product_image' => $item['product']->image,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            $this->command->info("Created order: {$order->order_number}");
        }

        $this->command->info('✅ Orders seeded successfully!');
    }
}
