<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone', 20)->nullable();   // user phone number
            $table->string('email')->nullable();       // optional but included
            $table->text('message')->nullable();                   // main user message

            $table->string('status')->default('unread'); // unread / read
            $table->string('ip_address')->nullable();     // track source

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
