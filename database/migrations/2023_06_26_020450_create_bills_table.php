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
        Schema::create('bills', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('bill_number');
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('voucher_id')->nullable()->constrained();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->text('desc')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->date('date_create')->nullable();
            $table->bigInteger('price_checkout')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
