<?php

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $this->call(UsersSeeder::class);
            $this->call(TimesSeeder::class);
            $this->call(TeachersSeeder::class);
            $this->call(MajorsSeeder::class);
            $this->call(LessonsSeeder::class);
        }
    }
