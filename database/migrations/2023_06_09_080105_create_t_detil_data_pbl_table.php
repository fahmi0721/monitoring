<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDetilDataPblTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_detail_data_pbl', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("data_pbl_id")->index()->unsigned();
            $table->char("akun_kode",6)->index();
            $table->char("sub_akun_kode",6)->index();   
            $table->double("jumlah")->default(0);
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
        Schema::dropIfExists('t_detail_data_pbl');
    }
}
