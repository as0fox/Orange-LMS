<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('image', 1000)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('isDeleted')->default(false);
           $table->timestamps();
            $table->softDeletes();  // Soft delete support
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
};
