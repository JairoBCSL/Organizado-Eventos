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
        Schema::create('local', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidade');
            $table->timestamps();
        });

        DB::table('local')->insert(['nome' => 'AD Eucaliptos', 'cidade_id' => 2]);
        DB::table('local')->insert(['nome' => 'AD Presidente Bandeira', 'cidade_id' => 1]);
        DB::table('local')->insert(['nome' => 'AD Central', 'cidade_id' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('local', function (Blueprint $table) {
            $table->dropForeign('local_cidade_id_foreign');
        });
        Schema::dropIfExists('local');
    }
};
