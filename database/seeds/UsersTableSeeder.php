<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin',
            'username' => 'admin_band',
            'email' => 'band@gmail.com',
            'password' => bcrypt('rootadmin'),

        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Author',
            'username' => 'author_band',
            'email' => 'author@gmail.com',
            'password' => bcrypt('rootauthor'),

        ]);
    }
}
