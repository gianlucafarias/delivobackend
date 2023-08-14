<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTypeInAdsPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_packages', function (Blueprint $table) {
            if (Schema::hasColumn('ads_packages', 'type')) {
                $table->renameColumn('type', 'input');
            } else {
                $table->smallInteger('input');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_packages', function (Blueprint $table) {
            if (Schema::hasColumn('ads_packages', 'type')) {
                $table->renameColumn('input', 'type');
            } else {
                $table->smallInteger('type');
            }
        });
    }
}
