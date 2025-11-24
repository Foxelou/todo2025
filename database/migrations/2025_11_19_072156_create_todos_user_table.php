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
        Schema::create('todos_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('todos_id');
            #Déclaraction de la clé primaire
            $table->primary(['user_id','todos_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('todos_id')->references('id')->on('todos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos_user');
    }
};
