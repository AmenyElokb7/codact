<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'cafeCategory')) {
            Schema::table('users', function (Blueprint $table) {
                $table->bigInteger('cafeCategory')->nullable()->unsigned();
                $table->foreign('cafeCategory')->references('id')->on('categories');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'cafeCategory')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['cafeCategory']);
                $table->dropColumn('cafeCategory');
            });
        }
    }
};
