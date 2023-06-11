<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSetTampilPbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_set_tampil_pbl', function (Blueprint $table) {
            $table->id();
            $table->string("keterangan",100);
            $table->text("akun_kodes")->nullable();
            $table->text("data_akun")->nullable();
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
        Schema::dropIfExists('t_set_tampil_pbl');
    }
}
