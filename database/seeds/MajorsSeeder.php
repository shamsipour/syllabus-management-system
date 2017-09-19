<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class MajorsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            DB::table('majors')->insert([
                ['id' => 1, 'name' => 'فناوری اطلاعات', 'level' => config('system.MAJOR_LEVELS')[0]['value']],
                ['id' => 2, 'name' => 'نرم افزار', 'level' => config('system.MAJOR_LEVELS')[0]['value']],
                ['id' => 3, 'name' => 'نرم افزار', 'level' => config('system.MAJOR_LEVELS')[1]['value']],
                ['id' => 4, 'name' => 'برق و الکترونیک', 'level' => config('system.MAJOR_LEVELS')[0]['value']],
                ['id' => 5, 'name' => 'برق و الکترونیک', 'level' => config('system.MAJOR_LEVELS')[1]['value']],
                ['id' => 6, 'name' => 'حسابداری', 'level' => config('system.MAJOR_LEVELS')[0]['value']],
                ['id' => 7, 'name' => 'عمومی', 'level' => config('system.MAJOR_LEVELS')[0]['value']],
                ['id' => 8, 'name' => 'عمومی', 'level' => config('system.MAJOR_LEVELS')[1]['value']],
            ]);
        }
    }
