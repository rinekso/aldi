<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->truncate();
        DB::table('user_role')->truncate();
        DB::table('tahun_ajaran')->truncate();
     //    DB::table('kelas')->truncate();
        DB::table('pembayaran')->truncate();
    	DB::table('jenis_transaksi')->truncate();
        $dt = new DateTime('2019-01-12 11:52:01');
        DB::table('tahun_ajaran')->insert([
            'nama' => '2019/2020',
            'created_at' => $dt->format('Y-m-d h:i:s')
        ]);
        DB::table('pembayaran')->insert([
            'id_kelas' => 0,
            'id_jenjang' => 0,
            'nama' => 'UTS',
            'keterangan' => 'bayar UTS',
            'nominal' => 50000,
            'periode' => 6,
            'tahun' => 2020,
            'bulan_start' => 3,
        ]);
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
    	DB::table('user_role')->insert([
    		'nama_role' => 'admin',
    	]);
        DB::table('user_role')->insert([
            'nama_role' => 'user',
        ]);
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
