<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bris', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->boolean('is_kantor_pusat')->default(false);
            $table->integer('kanwil_id')->nullable();
            $table->integer('kanca_kode')->nullable();
            $table->integer('kcp_kode')->nullable();
            $table->boolean('is_kck')->default(false);
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
        Schema::dropIfExists('user_bris');
    }
}
