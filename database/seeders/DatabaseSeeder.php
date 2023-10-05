<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert(['name' => 'Admin']);
        DB::table('user_type')->insert(['name' => 'Member']);

        DB::table('user_role')->insert(['name' => 'HR Manager']);
        DB::table('user_role')->insert(['name' => 'Back-end Developer']);
        DB::table('user_role')->insert(['name' => 'Front-end Developer']);
        DB::table('user_role')->insert(['name' => 'Quality Assurance']);
        DB::table('user_role')->insert(['name' => 'Project Manager']);
        DB::table('user_role')->insert(['name' => 'IT Manager']);
        DB::table('user_role')->insert(['name' => 'Database Administrator']);

        DB::table('users')->insert([
            'email' => 'admin@taskmgt.com',
            'password' => bcrypt('password'),
            'name' => 'Administrator',
            'user_type_id' => 1,
            'user_role_id' => 1
        ]);

        DB::table('task_status')->insert(['name' => 'New']);
        DB::table('task_status')->insert(['name' => 'In Progress']);
        DB::table('task_status')->insert(['name' => 'Completed']);

    }
}
