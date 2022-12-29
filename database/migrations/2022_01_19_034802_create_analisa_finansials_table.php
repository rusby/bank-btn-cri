<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalisaFinansialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_analisa_finansial', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('data_diri_id')->nullable(); // ini untuk relasi ke data diri jika jenis kredit nya flpp
            // $table->uuid('collection_id')->nullable();  ini untuk relasi ke data colecition jika jenis kredit nya komersil
            $table->string('pendapatan_bersih')->nullable();
            $table->string('penghasilan_pasangan')->nullable();
            $table->string('penghasilan_lainnya')->nullable();
            $table->string('angsuran_pinjaman_lain')->nullable();
            $table->string('jangka_waktu_kredit')->nullable();
            $table->string('harga_rumah')->nullable();
            $table->string('uang_muka')->nullable();
            $table->string('jumlah_permohonan_kredit')->nullable();
            $table->string('pernah_pinjam_di_bank_lain')->nullable();
            $table->string('jenis_fasilitas_di_bank_lain')->nullable();

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
        Schema::dropIfExists('data_analisa_finansial');
    }
}
