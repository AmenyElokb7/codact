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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->engine='innodb';
            $table->id();
            $table->unsignedBigInteger('cafe_owner_id');
            $table->unsignedBigInteger('user_id');
            $table->string('video');
            $table->date('startdate');
            $table->date('enddate');
            $table->time('time');
            $table->integer('period');
            $table->decimal('cost', 8, 2);
            $table->string('status');
            $table->timestamps();
        
            $table->foreign('cafe_owner_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
};
