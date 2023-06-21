<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUnitKerjaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->char("bisnis_area_kode",6)->index();
            $table->char("kode_unit_kerja")->unique()->index();
            $table->string("nama_unit_kerja",100)->default("-");
            $table->string("keterangan")->nullable();
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
        Schema::dropIfExists('m_unit_kerja');
    }
}
