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
        Schema::create('financial_summary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('Creator')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('status')->nullable();
            $table->string('compte')->nullable();
            $table->string('reference')->nullable();
            $table->dateTime('date_heure')->nullable();
            $table->string('photo_paiement')->nullable();
            $table->timestamps();
            
            // Define foreign key constraints if needed
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_summary');
    }
};