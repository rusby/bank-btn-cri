<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IndonesianCityDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinsi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provinsi',255);
            $table->integer('kode');            

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('updated_by')->nullable();
        });

        Schema::create('kota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kota',255);
            $table->unsignedInteger('id_provinsi');
            $table->boolean('is_kanwil')->default(false);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('kabupaten')->default(1);
        });

        Schema::create('kecamatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kecamatan',255);
            $table->unsignedInteger('id_kota');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('updated_by')->nullable();
        });

        Schema::create('kode_pos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_pos',255);
            $table->unsignedInteger('id_kecamatan');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('updated_by')->nullable();
        });

        Schema::create('kelurahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kelurahan',255);
            $table->unsignedInteger('id_kecamatan');
            $table->unsignedInteger('id_kode_pos');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinsi');
        Schema::dropIfExists('kota');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kode_pos');
        Schema::dropIfExists('kelurahan');
    }
}
