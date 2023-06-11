<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSubAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sub_akun', function (Blueprint $table) {
            $table->id();
            $table->char("akun_kode",6)->index();
            $table->char("kode_sub_akun",6)->unique()->index();
            $table->string("nama_sub_akun",100);
            $table->enum("tipe",array("p","b"))->default("p");
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
        Schema::dropIfExists('m_sub_akun');
    }
}
