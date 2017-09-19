<?php

use Illuminate\Database\Seeder;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('times')->insert([
            ['start' => '07:30', 'end' => '09:00'],
            ['start' => '07:30', 'end' => '10:00'],
            ['start' => '10:00', 'end' => '11:30'],
            ['start' => '10:00', 'end' => '12:30'],
            ['start' => '11:00', 'end' => '12:30'],
            ['start' => '11:00', 'end' => '15:00'],
            ['start' => '13:30', 'end' => '15:00'],
            ['start' => '15:15', 'end' => '16:45'],
            ['start' => '15:15', 'end' => '18:30'],
        ]);
    }
}
