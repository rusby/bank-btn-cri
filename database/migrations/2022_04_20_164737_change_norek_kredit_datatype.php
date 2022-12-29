<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNorekKreditDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('collection_files', function (Blueprint $table) {
            $table->bigInteger('norek_kredit')->change();
            $table->bigInteger('nominal_cair')->change();
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
            $table->integer('norek_kredit')->change();
            $table->integer('nominal_cair')->change();
        });
    }
}
