<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlasanBriToCollectionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_files', function (Blueprint $table) {
            $table->string('alasan_tolak_bri')->nullable();
            $table->string('nama_perbaikan_sbum')->nullable();
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
            $table->dropColumn('alasan_tolak_bri');
            $table->dropColumn('nama_perbaikan_sbum');
        });
    }
}
