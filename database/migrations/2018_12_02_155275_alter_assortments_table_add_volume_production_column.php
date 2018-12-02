<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAssortmentsTableAddVolumeProductionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assortments', function (Blueprint $table) {
            $table->unsignedInteger('volume_production')->nullable()->after('warning_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assortments', function (Blueprint $table) {
            $table->dropColumn('volume_production');
        });
    }
}
