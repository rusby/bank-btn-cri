<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaBankPenerimaSbumToUjiDataFlpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uji_data_flpp', function (Blueprint $table) {
            $table->string('nama_bank_penerima_sbum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uji_data_flpp', function (Blueprint $table) {
            $table->dropColumn('nama_bank_penerima_sbum');
        });
    }
}
