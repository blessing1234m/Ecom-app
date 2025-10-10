<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        $order = Order::create([
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '0123456789',
            'customer_address' => '123 Rue Principale',
            'notes' => 'Livrer rapidement',
            'subtotal' => 100.00,
            'shipping' => 10.00,
            'total_amount' => 110.00,
            'status' => 'pending',
        ]);

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'status' => 'pending',
        ]);
        $this->assertStringStartsWith('ECOM-', $order->order_number);
    }
}
