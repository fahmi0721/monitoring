<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSumberArusKasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sumber_arus_kas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("data_pbl_id")->index()->unsigned();
            $table->char("arus_kas_kode",6)->index();
            $table->double("penerimaan");
            $table->double("pengeluaran");
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
        Schema::dropIfExists('t_sumber_arus_kas');
    }
}
