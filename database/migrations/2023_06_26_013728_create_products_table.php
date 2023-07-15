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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('number');
            $table->string('name');

            $table->string('slug')->unique()->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreignId('ram_id')->nullable()->constrained();
            $table->foreignId('cpu_id')->nullable()->constrained();
            $table->foreignId('hard_driver_id')->nullable()->constrained();
            $table->foreignId('graphics_id')->nullable()->constrained();
            $table->foreignId('maiboard_id')->nullable()->constrained();

            $table->foreignId('brand_id')->nullable()->constrained();
            $table->text('image')->nullable();
            $table->longText('desc')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('in_price')->default(0);
            $table->bigInteger('out_price')->default(0)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
