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
        Schema::create('bill_detail_imports', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->foreignId('bill_import_id')->constrained();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('price')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_detail_imports');
    }
};
