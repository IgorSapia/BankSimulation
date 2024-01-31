<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sent_id')->unique()->comment('Transação enviada');
            $table->unsignedBigInteger('recived_id')->unique()->comment('Transação recebida');
            $table->timestamps();

            //FK
            $table->foreign('sent_id')->references('id')->on('statements');
            $table->foreign('recived_id')->references('id')->on('statements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
