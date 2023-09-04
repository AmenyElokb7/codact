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
        Schema::create('users', function (Blueprint $table) {
            $table->engine='innodb';   
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('phoneno');
            $table->string('cafeName')->nullable();
            $table->unsignedBigInteger('cafeCategory')->nullable();
            $table->integer('minAge')->nullable();
            $table->integer('maxAge')->nullable();
            $table->string('profession')->nullable();
            $table->time('Opentime')->nullable();
            $table->time('Closetime')->nullable();
            $table->time('Besttime')->nullable();
            $table->integer('tablesno')->nullable();
            $table->string('image')->nullable();
            $table->float('balance')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
