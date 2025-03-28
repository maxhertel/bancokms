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
        Schema::create('cartaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->foreignId('banco_id')->constrained()->onDelete('cascade');
            $table->string('numero')->unique();
            $table->date('validade');
            $table->string('cvv');
            $table->string('tipo'); // Débito, Crédito, etc.
            $table->decimal('limite', 15, 2)->nullable();
            $table->decimal('saldo', 15, 2)->default(0);
            $table->string('estado')->default('ativo'); // ativo, bloqueado, cancelado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartaos');
    }
};
