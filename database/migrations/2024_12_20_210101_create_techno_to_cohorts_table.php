<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('techno_to_cohorts', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('technology_id'); // Foreign key to technologies table
            $table->unsignedBigInteger('cohort_id'); // Foreign key to cohorts table
            $table->date('start_date')->nullable(); // New start_date column
            $table->date('end_date')->nullable(); // New end_date column
            $table->timestamps(); // Created_at and updated_at columns

            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
        });

        Schema::table('technologies', function (Blueprint $table) {
            $table->date('start_date')->nullable()->change(); // Update start_date column to allow NULL values
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->date('start_date')->nullable(false)->change(); // Revert start_date column to not allow NULL values
        });

        Schema::dropIfExists('techno_to_cohorts');
    }
};
