<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        DB::table('status')->insert(['nome' => 'Inscrições Abertas']); // 1
        DB::table('status')->insert(['nome' => 'Pausado']);
        DB::table('status')->insert(['nome' => 'Inscrições Encerradas']);
        DB::table('status')->insert(['nome' => 'Finalizado']);
        DB::table('status')->insert(['nome' => 'Aguardando Pagamento']); // 5
        DB::table('status')->insert(['nome' => 'Processando Pagamento']);
        DB::table('status')->insert(['nome' => 'Aprovada']);
        DB::table('status')->insert(['nome' => 'Cancelada']);
        DB::table('status')->insert(['nome' => 'Recusada']);
        DB::table('status')->insert(['nome' => 'Aprovado']); // 10
        DB::table('status')->insert(['nome' => 'Em Processamento']);
        DB::table('status')->insert(['nome' => 'Recusado']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
