<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameJenisNoSuratTanah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_agunan', function (Blueprint $table) {
            $table->renameColumn('jenis_no_surat_tanah', 'no_surat_tanah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_agunan', function (Blueprint $table) {
            $table->renameColumn('no_surat_tanah', 'jenis_no_surat_tanah');
        });
    }
}
