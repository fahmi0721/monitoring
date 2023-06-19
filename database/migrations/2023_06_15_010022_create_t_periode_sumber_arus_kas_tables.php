<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPeriodeSumberArusKasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_periode_sumber_arus_kas', function (Blueprint $table) {
            $table->id();
            $table->char("periode",6)->index()->unique();
            $table->string("keterangan")->nullable();
            $table->double("saldo_awal");
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
        Schema::dropIfExists('t_periode_sumber_arus_kas');
    }
}
