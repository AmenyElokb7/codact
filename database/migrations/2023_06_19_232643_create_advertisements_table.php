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
            $table->engine = 'innodb';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('video');
            $table->date('startdate');
            $table->date('enddate');
            $table->time('time');
            $table->integer('period');
            $table->decimal('cost', 8, 2);
            $table->string('status');
            $table->string('pdf')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('advertisement_cafe_owner', function (Blueprint $table) {
            $table->engine = 'innodb';
            $table->unsignedBigInteger('advertisement_id');
            $table->unsignedBigInteger('cafe_owner_id');
            
            $table->foreign('advertisement_id')->references('id')->on('advertisements')->onDelete('cascade');
            $table->foreign('cafe_owner_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->primary(['advertisement_id', 'cafe_owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisement_cafe_owner');
        Schema::dropIfExists('advertisements');
    }
};
