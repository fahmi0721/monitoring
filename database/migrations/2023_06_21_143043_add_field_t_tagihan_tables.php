<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTTagihanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_tagihan', function (Blueprint $table) {
            $table->enum("status",array("belum_lunas","lunas"))->default("belum_lunas");
            $table->date("tgl_lunas")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_tagihan', function (Blueprint $table) {
            //
        });
    }
}
