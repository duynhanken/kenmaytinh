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
        Schema::create('main_boards', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('size')->nullable();
            $table->string('chipset')->nullable();
            $table->string('usbgate')->nullable();
            $table->string('ramslots')->nullable();
            $table->string('manufacturer')->nullable();
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
        Schema::dropIfExists('main_boards');
    }
};
