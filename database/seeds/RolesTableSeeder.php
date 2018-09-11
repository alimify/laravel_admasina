<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'title' => 'Admin',
                'slug' => 'admin',
                'image' => 'admin.png',
                'is_active' => true
            ],
            [
                'id' => 2,
                'title' => 'Member',
                'slug' => 'member',
                'image' => 'member.png',
                'is_active' => true
            ]
        ]);
    }
}
