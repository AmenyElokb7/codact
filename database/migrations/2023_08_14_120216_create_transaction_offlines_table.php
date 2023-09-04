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
        Schema::create('transaction_offline', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('montant'); // Example: Maximum 10 digits, 2 decimal places
            $table->string('status')->default('Waiting');
            $table->string('compte');
            $table->string('reference');
            $table->dateTime('date_heure'); // Using timestamp for date and time
            $table->string('photo_paiement');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_offline');
    }
};