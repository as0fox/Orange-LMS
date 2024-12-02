<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcademyIdToTrainersTable extends Migration
{
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->unsignedBigInteger('academy_id')->after('isDeleted'); // Add academy_id column
            $table->foreign('academy_id')->references('id')->on('academies')->onDelete('cascade'); // Add foreign key
        });
    }

    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropForeign(['academy_id']); // Drop foreign key
            $table->dropColumn('academy_id'); // Drop academy_id column
        });
    }
}
