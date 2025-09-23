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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('order_number', 20)->unique(); // Limit length for optimization
            $table->boolean('is_ordered')->default(false);
            $table->enum('status', ['pending', 'delivered', 'rejected', 'intransit','returned'])->default('pending');
            $table->decimal('total_amount', 15, 2)->default(0.00);
            $table->decimal('shipping_charge', 15, 2)->default(0.00);
            $table->enum('payment_status', ['paid', 'unpaid', 'refunded'])->default('unpaid');
            $table->string('payment_method')->nullable();
            $table->string('tracking_number')->nullable()->index(); // Indexed for performance
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
