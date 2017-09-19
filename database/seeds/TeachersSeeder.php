<?php

use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            ['name' => 'علی', 'family' => 'میقانی', 'email' => 'test1@gmail.com', 'mobile' => '09121234567'],
            ['name' => 'حسین', 'family' => 'معصوم زاده', 'email' => 'test2@gmail.com', 'mobile' => '09121234527'],
            ['name' => 'امید', 'family' => 'ابراهیمی', 'email' => 'test3@gmail.com', 'mobile' => '09121234467'],
            ['name' => 'غلام', 'family' => 'برنجی تهرانی', 'email' => 'test4@gmail.com', 'mobile' => '09121284567'],
        ]);
    }
}
