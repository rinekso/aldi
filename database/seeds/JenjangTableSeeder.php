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
            'nama_jenjang' => 'smp',
        ]);
        DB::table('jenjang')->insert([
            'nama_jenjang' => 'sma',
        ]);
    }
}
