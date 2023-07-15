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
        Schema::create('bill_imports', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('users_id')->constrained();
            $table->bigInteger('total_price')->default(0);
            $table->date('date_create')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_imports');
    }
};
