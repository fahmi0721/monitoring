<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyMProyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_proyek', function (Blueprint $table) {
            $table->foreign("unit_kerja_kode")->references("kode_unit_kerja")->on("m_unit_kerja")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_proyek', function (Blueprint $table) {
            //
        });
    }
}
