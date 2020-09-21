<?php

use Illuminate\Database\Seeder;

class JenjangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('jenjang')->truncate();
        DB::table('jenjang')->insert([
            'nama_jenjang' => 'sd',
            'max_tingkat' => 6
        ]);
        DB::table('jenjang')->insert([
            'nama_jenjang' => 'smp',
            'max_tingkat' => 3
        ]);
        DB::table('jenjang')->insert([
            'nama_jenjang' => 'sma',
            'max_tingkat' => 3
        ]);
    }
}
