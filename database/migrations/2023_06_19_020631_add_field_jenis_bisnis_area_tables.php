<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldJenisBisnisAreaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_bisnis_area', function (Blueprint $table) {
            $table->enum("jenis", array("afiliasi","berelasi","swasta"))->default("afiliasi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_bisnis_area', function (Blueprint $table) {
            //
        });
    }
}
