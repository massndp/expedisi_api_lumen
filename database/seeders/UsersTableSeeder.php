<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        user::create([
            'name'=> 'Bayu Adi P',
            'identity_id' => '12345678',
            'gender' => 1,
            'address' => 'Jalan Jend Sudirman No 44',
            'photo' => 'sundep.png',
            'email' => 'bayu@mail.com',
            'password' => app('hash')->make(12345678),
            'phone_number' => '0812723040444',
            'api_token' => Str::random(40),
            'role' =>0,
            'status' => 1,
        ]);
    }
}
