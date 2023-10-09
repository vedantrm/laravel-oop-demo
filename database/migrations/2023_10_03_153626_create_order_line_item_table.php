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
        Schema::create('order_line_item', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->string('name')->default('');
            $table->integer('quantity')->default(0);
            $table->string('sku')->default('');
            $table->float('price')->default(0);
            $table->float('discount')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_line_item');
    }
};
