<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([ 'role_name' => 'Vendor']);
        Role::create([ 'role_name' => 'Konsumen']);
    }
}
