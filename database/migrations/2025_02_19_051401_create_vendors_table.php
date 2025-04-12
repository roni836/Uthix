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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->date('dob')->nullable();
            $table->text('address')->nullable();
            $table->string('store_name')->nullable();
            $table->text('store_address')->nullable();
            $table->string('logo')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('school')->nullable();
            $table->string('counter')->default(0);
            $table->string('status')->nullable();
            $table->boolean('isApproved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
