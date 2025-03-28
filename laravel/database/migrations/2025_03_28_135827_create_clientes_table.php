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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banco_id')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->string('bi_number')->unique(); // Número do bilhete de identidade angolano
            $table->date('data_nascimento');
            $table->string('genero');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->string('profissao')->nullable();
            $table->decimal('rendimento', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
