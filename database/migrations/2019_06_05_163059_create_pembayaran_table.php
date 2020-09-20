<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran',function(Blueprint $table){
            $table->increments('id_pembayaran');
            $table->integer('id_kelas');
            $table->integer('id_periode');
            $table->integer('id_jenjang');
            $table->integer('nama');
            $table->integer('keterangan');
            $table->integer('nominal');
            $table->integer('periode');
            $table->integer('tahun');
            $table->integer('bulan_start');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
