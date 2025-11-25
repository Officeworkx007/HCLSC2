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
        Schema::create('gallery_photo', function (Blueprint $table) {
            $table->id();

            // Foreign Key linking to the album
            $table->foreignId('gallery_album_id')
                ->constrained('gallery_album')
                ->onDelete('cascade'); // Delete photos if the album is deleted

            $table->string('file_path'); // Path to the uploaded photo file
            $table->string('file_name', 255);
            $table->integer('order_column')->default(0); // For custom sorting
            $table->boolean('is_cover')->default(false); // Optional: Flag for the album cover
            $table->text('caption')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_photo');
    }
};
