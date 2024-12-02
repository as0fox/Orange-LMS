<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            // $table->string('name', 1); // A single letter for classroom
            // $table->boolean('active')->default(true);
            // $table->boolean('is_deleted')->default(false);

            // $table->foreignId('cohort_id')->constrained()->onDelete('cascade');
            // $table->foreignId('trainer_id')->constrained()->onDelete('cascade');
            // $table->timestamps();
            // $table->softDeletes();

            // // Indexes
            // $table->index('cohort_id');
            // $table->index('trainer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
