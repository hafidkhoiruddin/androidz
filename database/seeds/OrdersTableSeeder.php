<?php

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = Vendor::find(1);

        Order::create([
            'user_id' => 2,
            'vendor_id' => $vendor->id,
            'soccer_field_id' => 2,
            'date' => '2018-11-30',
            'start_time' => '14.00',
            'end_time' => '16.00',
            'price' => (16.00 - 14.00) * $vendor->vendor_price
        ]);
    }
}
