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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->boolean('marital_status')->default(0);

            $table->string('spouse_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('number', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('token_number')->nullable()->unique();
            $table->string('status')->default('Pending');

            // Foreign keys for dropdowns (All constraints are kept as you originally defined them)
            $table->foreignId('gender_id')->nullable()->constrained('genders')->nullOnDelete();
            $table->foreignId('religion_id')->nullable()->constrained('religions')->nullOnDelete();
            $table->foreignId('caste_id')->nullable()->constrained('castes')->nullOnDelete();
            $table->foreignId('occupation_id')->nullable()->constrained('occupations')->nullOnDelete();
            $table->foreignId('income_id')->nullable()->constrained('incomes')->nullOnDelete();

            // Keeping singular constraint to match your controller validation logic: `exists:eligibility_category,id`
            $table->foreignId('eligibility_category_id')->nullable()->constrained('eligibility_category')->nullOnDelete();

            $table->foreignId('panel_lawyer_id')->nullable()->constrained('panel_lawyers')->nullOnDelete();
            $table->string('certificate_no', 50)->nullable();
            $table->string('employment_details', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
