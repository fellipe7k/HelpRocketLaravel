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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('status', ['aberto', 'em_andamento', 'resolvido', 'fechado'])->default('aberto');
            $table->enum('prioridade', ['baixa', 'media', 'alta', 'critica'])->default('media');
            $table->enum('categoria', ['hardware', 'software', 'rede', 'acesso', 'outros'])->default('outros');
            $table->enum('departamento', ['ti', 'rh', 'financeiro', 'marketing', 'vendas', 'operacoes'])->default('ti');
            $table->enum('localizacao', ['sede', 'filial_a', 'filial_b', 'remoto'])->default('sede');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('atendente_id')->nullable()->constrained('users');
            $table->dateTime('data_abertura');
            $table->dateTime('data_fechamento')->nullable();
            $table->date('data_limite')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->boolean('notificar_email')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};