<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyTArusKasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_sumber_arus_kas', function (Blueprint $table) {
            $table->foreign('arus_kas_kode')->references('kode_arus_kas')->on('m_sumber_arus_kas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_sumber_arus_kas', function (Blueprint $table) {
            //
        });
    }
}
