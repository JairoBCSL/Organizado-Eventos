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
        Schema::create('inscricao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user');
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('evento');
            $table->date('data');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscricao', function (Blueprint $table) {
            $table->dropForeign('inscricao_user_id_foreign');
            $table->dropForeign('inscricao_evento_id_foreign');
            $table->dropForeign('inscricao_status_id_foreign');
        });
        Schema::dropIfExists('inscricao');
    }
};
