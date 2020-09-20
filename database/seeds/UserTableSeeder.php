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
    	// DB::table('users')->truncate();
     //    DB::table('user_role')->truncate();
     //    DB::table('jenjang')->truncate();
     //    DB::table('kelas')->truncate();
    	// DB::table('jenis_transaksi')->truncate();
        DB::table('users')->insert([
            'id_jenjang' => 1,
            'id_kelas' => 1,
            'id_user_role' => 1,
            'nama' => 'admin',
            'rfid' => 'asd',
            'nik' => 123,
            'id_tahun_ajaran' => 1,
            'saldo' => 0,
            'password' => \Illuminate\Support\Facades\Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'id_jenjang' => 1,
            'id_kelas' => 1,
            'id_user_role' => 2,
            'nama' => 'topup',
            'rfid' => '123',
            'nik' => 123,
            'id_tahun_ajaran' => 1,
            'saldo' => 0,
            'password' => \Illuminate\Support\Facades\Hash::make('123'),
        ]);
    	DB::table('users')->insert([
    		'id_jenjang' => 1,
    		'id_kelas' => 1,
    		'id_user_role' => 3,
    		'nama' => 'aldi2',
            'rfid' => 'asd123',
    		'nik' => 123,
    		'id_tahun_ajaran' => 1,
    		'saldo' => 0,
    		'password' => \Illuminate\Support\Facades\Hash::make('123'),
    	]);
    	// DB::table('user_role')->insert([
    	// 	'nama_role' => 'admin',
    	// ]);
     //    DB::table('user_role')->insert([
     //        'nama_role' => 'user',
     //    ]);
     //    DB::table('kelas')->insert([
     //        'tingkat' => 1,
     //    ]);
     //    DB::table('kelas')->insert([
     //        'tingkat' => 2,
     //    ]);
     //    DB::table('kelas')->insert([
     //        'tingkat' => 3,
     //    ]);
     //    DB::table('jenjang')->insert([
     //        'nama_jenjang' => 'smp',
     //    ]);
     //    DB::table('jenjang')->insert([
     //        'nama_jenjang' => 'sma',
     //    ]);
     //    DB::table('jenjang')->insert([
     //        'nama_jenjang' => 'smk',
     //    ]);
     //    DB::table('jenjang')->insert([
     //        'nama_jenjang' => 'mts',
     //    ]);
     //    DB::table('jenis_transaksi')->insert([
     //        'nama_transaksi' => 'SPP',
     //    ]);
     //    DB::table('jenis_transaksi')->insert([
     //        'nama_transaksi' => 'UTS',
     //    ]);
     //    DB::table('jenis_transaksi')->insert([
     //        'nama_transaksi' => 'UAS',
     //    ]);
     //    DB::table('jenis_transaksi')->insert([
     //        'nama_transaksi' => 'Kalender',
     //    ]);
     //    DB::table('jenis_transaksi')->insert([
     //        'nama_transaksi' => 'Buku',
     //    ]);
    	// DB::table('jenis_transaksi')->insert([
    	// 	'nama_transaksi' => 'Kartu Pelajar',
     //    ]);
    }
}
