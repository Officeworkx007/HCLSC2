<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('description');  // short description of the notice
            $table->string('order_no')->nullable(); // optional order number
            $table->date('notice_date'); // date of the order/notice
            $table->boolean('status')->default(1); // 1 = Active, 0 = Not Active
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
