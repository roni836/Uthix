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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->index();
            $table->string('slug')->unique();

            $table->string('author',255)->index();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');            
            $table->string('isbn', 20)->unique()->nullable();
            $table->string('language', 50)->default('English');
            $table->integer('pages')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail_img', 255)->nullable();
            $table->double('rating', 8, 2)->default(0.00);
            $table->double('price', 20, 2)->index();
            $table->double('discount_price', 20, 2)->nullable();
            $table->string('discount_type',10)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('min_qty')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_published')->default(1); //status
            $table->integer('num_of_sales')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
