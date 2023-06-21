<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTagihanTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tagihan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("proyek_id")->unsigned()->index();
            $table->bigInteger("periode_id")->unsigned()->index();
            $table->string("keterangan")->default("-");
            $table->date("tgl_invoice");
            $table->double("jumlah");
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
        Schema::dropIfExists('t_tagihan');
    }
}
