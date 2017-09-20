<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = env('ADMIN_NAME', "دانشکده شمسی پور");
        $user->username = env('ADMIN_USERNAME', 'erfansahaf');
        $user->email = env("ADMIN_EMAIL", "erfan.sahaf@gmail.com");
        $user->password = \Illuminate\Support\Facades\Hash::make(env('ADMIN_PASSWORD', '123456'));
        $user->save();
    }
}
