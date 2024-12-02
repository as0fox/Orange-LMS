<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternateTechnoToCohortsTable extends Migration
{
    public function up()
    {
        Schema::create('techno_to_cohorts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technology_id');
            $table->unsignedBigInteger('cohort_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('techno_to_cohorts');
    }
}

