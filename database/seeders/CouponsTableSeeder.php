<?php

namespace Database\Seeders;

use App\Models\Coupons;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupons::create([
            'code' => 'FIXED10',
            'type' => 'fixed',
            'value_off' => 10,
            'minimum_price' => 50.00,
            'minimum_quantity' => 1,
        ]);
        Coupons::create([
            'code' => 'PERCENT10',
            'type' => 'percent',
            'percentage_off' => 10,
            'minimum_price' => 100.00,
            'minimum_quantity' => 2,
        ]);
        Coupons::create([
            'code' => 'MIXED10',
            'type' => 'mixed',
            'value_off' => 10,
            'percentage_off' => 10,
            'minimum_price' => 200.00,
            'minimum_quantity' => 3,
        ]);
        Coupons::create([
            'code' => 'REJECTED10',
            'type' => 'Both',
            'value_off' => 10,
            'percentage_off' => 10,
            'minimum_price' => 1000.00,
            'minimum_quantity' => 1
        ]);
    }
}
