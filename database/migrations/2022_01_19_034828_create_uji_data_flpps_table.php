<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiDataFlppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji_data_flpp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('data_diri_id');
            $table->string('jenis_badan_hukum_developer')->nullable();
            $table->string('nama_badan_hukum_developer')->nullable();
            $table->string('nama_perumahan')->nullable();
            $table->string('kode_pos_agunan')->nullable();            
            $table->string('subsidi_uang_muka')->nullable();
            $table->string('npwp_pengembang')->nullable();
            $table->string('blok_alamat_agunan')->nullable();
            $table->string('no_alamat_agunan')->nullable();
            $table->string('id_rumah')->nullable();
            $table->string('id_struktur')->nullable();
            $table->string('no_slf')->nullable();
            $table->string('tanggal_slf')->nullable();
            $table->string('no_rek_penerima_sbum')->nullable();
            $table->string('no_rek_developer')->nullable();

            $table->uuid('createdBy');
            $table->uuid('updatedBy')->nullable();
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
        Schema::dropIfExists('uji_data_flpp');
    }
}
