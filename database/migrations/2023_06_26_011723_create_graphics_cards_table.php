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
        Schema::create('graphics_cards', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('apacity')->nullable();
            $table->string('manufacturer')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graphics_cards');
    }
};
