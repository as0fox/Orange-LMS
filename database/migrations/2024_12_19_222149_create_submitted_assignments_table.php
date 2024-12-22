<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_assignments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('assignment_id'); // Foreign key to assignments
            $table->unsignedBigInteger('trainee_id'); // Foreign key to users
            $table->string('submission_link')->nullable(); // Link to the submission
            $table->text('comments')->nullable(); // Optional comments
            $table->enum('status', ['submitted', 'not submitted'])->default('not submitted'); // Status
            $table->timestamp('submitted_at')->nullable(); // Date and time of submission
            $table->timestamps(); // Created at and updated at

            // Foreign key constraints
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
            $table->foreign('trainee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitted_assignments');
    }
}
