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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->enum('status', ["draft","open","cancelled","archived"])->default("draft");
            $table->enum('payment_status', ["paid","unpaid"])->default("unpaid");
            $table->text('customer_note')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->float('sub_total')->default(0);
            $table->float('discount_total')->default(0);
            $table->float('shipping_handling_total')->default(0);
            $table->float('grand_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
