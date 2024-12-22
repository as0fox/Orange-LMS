<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainee_id')->constrained()->onDelete('cascade');
            $table->text('reason')->nullable(); // Make reason nullable, since not all absences will have one
            $table->enum('absence_type', ['Excused', 'Unexcused', 'Delay']); // New column to store absence type
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->integer('absences_count')->default(0);
            $table->timestamp('requested_at')->useCurrent();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
