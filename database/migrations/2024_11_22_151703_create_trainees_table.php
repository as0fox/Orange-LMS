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
        if (!Schema::hasTable('trainees')) {
            Schema::create('trainees', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('email', 100)->unique();
                $table->string('password');
                $table->string('address', 100)->nullable();
                $table->string('phone', 15)->nullable();
                $table->string('image', 1000)->nullable();
                $table->boolean('active')->default(true);
                $table->foreignId('cohort_id')->nullable()->constrained()->onDelete('set null');
                $table->foreignId('academy_id')->nullable()->constrained()->onDelete('set null'); // New Academy relationship
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            Schema::table('trainees', function (Blueprint $table) {
                if (Schema::hasColumn('trainees', 'trainer_id')) {
                    $table->dropColumn('trainer_id'); // Drop trainer_id
                }

                if (Schema::hasColumn('trainees', 'classroom_name')) {
                    $table->dropColumn('classroom_name'); // Drop classroom_name
                }

                // Add academy_id column
                if (!Schema::hasColumn('trainees', 'academy_id')) {
                    $table->foreignId('academy_id')->nullable()->constrained()->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainees', function (Blueprint $table) {
            if (Schema::hasColumn('trainees', 'academy_id')) {
                $table->dropForeign(['academy_id']);
                $table->dropColumn('academy_id'); // Drop academy_id
            }
        });

        // If you want to drop the entire trainees table, uncomment the following line
        // Schema::dropIfExists('trainees');
    }
};
