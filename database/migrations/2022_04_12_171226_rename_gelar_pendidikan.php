<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGelarPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_diri', function (Blueprint $table) {
            $table->renameColumn('gelar_pendidikan', 'pendidikan_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_diri', function (Blueprint $table) {
            $table->renameColumn('pendidikan_terakhir', 'gelar_pendidikan');
        });
    }
}
