<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \App\Rinekso\User\User::create([
            'name' => 'rinekso',
            'email' => 'simson@rinekso.id',
            'password' => \Illuminate\Support\Facades\Hash::make('admin')
        ]);
    }
}
