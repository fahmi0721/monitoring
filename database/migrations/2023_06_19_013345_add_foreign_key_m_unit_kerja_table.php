<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyMUnitKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_unit_kerja', function (Blueprint $table) {
            $table->foreign("bisnis_area_kode")->references("kode_bisnis_area")->on("m_bisnis_area")->onDelete("restrict");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_unit_kerja', function (Blueprint $table) {
            //
        });
    }
}
