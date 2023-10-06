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
            $table->string('name');
            $table->integer('quantity');
            $table->string('sku');
            $table->float('price');
            $table->float('discount');
            $table->float('total');
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
