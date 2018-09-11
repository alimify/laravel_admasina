<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Abdul Alim',
            'email' => 'alimifypro@gmail.com',
            'role_id' => 1,
            'quote' => 'Pain In Coding, Gain In Coding',
            'is_active' => true,
            'password' => Hash::make('alimifypro'),
            'created_at' => Carbon::now()
           ],
            [
                'name' => 'Zemen',
                'email' => 'zemen81@yahoo.com',
                'role_id' => 1,
                'quote' => '..',
                'is_active' => true,
                'password' => Hash::make('zemenfes'),
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
