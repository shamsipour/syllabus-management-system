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
        $user->name = "عرفان صحاف نژاد";
        $user->username = "erfansahaf";
        $user->email = "erfan.sahaf@gmail.com";
        $user->password = \Illuminate\Support\Facades\Hash::make("123456");
        $user->save();
    }
}
