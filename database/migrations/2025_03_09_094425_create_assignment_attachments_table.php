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
        Schema::create('assignment_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('announcement_id')->nullable()->constrained('announcements')->onDelete('cascade'); 
            $table->foreignId('assignment_upload_id')->nullable()->constrained('assignment_uploads')->onDelete('cascade'); 
            $table->string('attachment_file', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_attachments');
    }
};
