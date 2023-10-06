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
        Schema::create('order_billing_detail', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('order')->onDelete('cascade');
            $table->string('contact_name')->nullable();
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('town')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode');
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_billing_detail');
    }
};
