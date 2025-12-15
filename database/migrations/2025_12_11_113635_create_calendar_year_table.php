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
        Schema::create('calendar_year_table', function (Blueprint $table) {
            $table->id();
            $table->string('title');                     // Event title
            $table->date('event_date');                 // Event date
            $table->text('description')->nullable();    // Details/notes
            $table->string('link')->nullable();         // Optional external link
            $table->string('image')->nullable();        // Optional image/file
            $table->timestamps();

            // Useful for fast lookup when clicking dates
            $table->index('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_year_table');
    }
};
