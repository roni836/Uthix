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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->string('alt_phone', 15)->nullable();
            $table->string('address_type')->nullable();
            $table->string('landmark')->nullable();
            $table->string('street')->nullable();
            $table->string('area')->nullable();
            $table->string('city');
            $table->string('state'); // Missing in your code
            $table->string('postal_code')->nullable();
            $table->string('country')->default('India');
            $table->boolean('is_default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
