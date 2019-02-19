<?php

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'user_id' => 1,
            'vendor_name' => 'Good Futsal',
            'vendor_price' => 100000
        ]);
    }
}
