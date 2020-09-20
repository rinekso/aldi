<?php

use Illuminate\Database\Seeder;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->truncate();
        DB::table('kelas')->insert([
            'tingkat' => 1,
        ]);
        DB::table('kelas')->insert([
            'tingkat' => 2,
        ]);
        DB::table('kelas')->insert([
            'tingkat' => 3,
        ]);
    }
}
