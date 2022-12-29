<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoTelpDebitur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_files', function (Blueprint $table) {
            $table->string('no_telp_debitur')->nullable();
            $table->string('no_kk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('collection_files', function (Blueprint $table) {
            $table->dropColumn('no_telp_debitur');
            $table->dropColumn('no_kk');
        });
    }
}
