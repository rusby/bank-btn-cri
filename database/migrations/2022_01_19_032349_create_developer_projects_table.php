<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeveloperProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('developer_id')->nullable();
            $table->string('project_name');
            $table->string('project_description')->nullable();
            $table->string('no_imb')->nullable();
            $table->string('tgl_imb')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('tgl_sertifikat')->nullable();
            $table->string('folder')->nullable();
            $table->string('files_slf')->nullable();
            $table->string('files_imb')->nullable();
            $table->string('files_pbb')->nullable();
            $table->string('files_sertifikat')->nullable();
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
        Schema::dropIfExists('developer_projects');
    }
}
