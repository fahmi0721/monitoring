<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_akun', function (Blueprint $table) {
            $table->id();
            $table->char("kode_akun",6)->unique()->index();
            $table->string("nama_akun",100);
            $table->enum("tipe", array("p","b"))->default("p");
            $table->text("keterangan");
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
        Schema::dropIfExists('m_akun');
    }
}
