<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSumberArusKasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sumber_arus_kas', function (Blueprint $table) {
            $table->id();
            $table->char("kode_arus_kas", 6)->index()->unique();
            $table->string("nama_arus_kas",100)->nullable();
            $table->string("keterangan",100)->nullable();
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
        Schema::dropIfExists('m_sumber_arus_kas');
    }
}
