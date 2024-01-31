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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment("Operação realizada por");
            $table->unsignedBigInteger('statement_type_id')->comment("Tipo de Operação realizada");
            $table->bigInteger('value')->comment("Valor da Operação");
            $table->timestamps();

            //FK
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('statement_type_id')->references('id')->on('statement_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statement');
    }
};
