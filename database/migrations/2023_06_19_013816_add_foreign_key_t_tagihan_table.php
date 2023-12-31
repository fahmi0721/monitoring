<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_tagihan', function (Blueprint $table) {
            $table->foreign("proyek_id")->references("id")->on("m_proyek")->onDelete("restrict");
            $table->foreign("periode_id")->references("id")->on("t_periode_tagihan")->onDelete("restrict");
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
