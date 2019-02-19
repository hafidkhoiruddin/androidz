<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = app('hash')->make('secret');
        
        User::create([
           'role_id' => 1,
           'name' => 'I am Vendor',
           'email' => 'vendor@app.com',
           'password' => $password
        ]);

        User::create([
           'role_id' => 2,
           'name' => 'I am User',
           'email' => 'user@app.com',
           'password' => $password
        ]);
    }
}
