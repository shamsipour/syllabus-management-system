<?php

use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            ['name' => 'سیستم عامل', 'units' => 3, 'major_id' => 2],
            ['name' => 'طراحی صفحات وب', 'units' => 3, 'major_id' => 2],
            ['name' => 'گرافیک کامپیوتری', 'units' => 2, 'major_id' => 1],
            ['name' => 'اندیشه اسلامی', 'units' => 2, 'major_id' => 7],
            ['name' => 'خانواده و جمعیت', 'units' => 2, 'major_id' => 7],
            ['name' => 'مهندسی فناوری اطلاعات', 'units' => 3, 'major_id' => 1],
        ]);
    }
}
