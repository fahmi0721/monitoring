<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_detail_data_pbl', function (Blueprint $table) {
            $table->foreign('akun_kode')->references('kode_akun')->on('m_akun')->onDelete('restrict');
            $table->foreign('sub_akun_kode')->references('kode_sub_akun')->on('m_sub_akun')->onDelete('restrict');
            $table->foreign('data_pbl_id')->references('id')->on('t_data_pbl')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_detail_data_pbl', function (Blueprint $table) {
            //
        });
    }
}
