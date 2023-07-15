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
        Schema::create('cpus', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('producer')->nullable();
            $table->string('cpuspeed')->nullable();
            $table->string('width')->nullable();
            $table->string('cache')->nullable();
            $table->longText('desc')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpus');
    }
};
