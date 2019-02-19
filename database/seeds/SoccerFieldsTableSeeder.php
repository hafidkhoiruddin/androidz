<?php

use App\Models\SoccerField;
use Illuminate\Database\Seeder;

class SoccerFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SoccerField::create(['vendor_id' => 1, 'field_name' => 'Lapangan A']);
        SoccerField::create(['vendor_id' => 1, 'field_name' => 'Lapangan B']);
        SoccerField::create(['vendor_id' => 1, 'field_name' => 'Lapangan C']);
    }
}
