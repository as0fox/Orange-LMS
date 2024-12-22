<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->datetime('deadline');
            $table->foreignId('technology_id')->constrained()->onDelete('cascade');
            $table->foreignId('academy_id')->constrained()->onDelete('cascade');
            $table->foreignId('cohort_id')->constrained()->onDelete('cascade');
            $table->boolean('active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
