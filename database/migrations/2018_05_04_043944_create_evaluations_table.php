<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_unit_id')->index();
            $table->string('structure')->nullable();
            $table->string('how_it_is_taught')->nullable();
            $table->string('relevance')->nullable();
            $table->string('lecture_room')->nullable();
            $table->text('description_about_lecture_room')->nullable();
            $table->string('tutor')->nullable();
            $table->text('changes_suggested')->nullable();
            $table->text('non_changes_suggested')->nullable();
            $table->text('recommendations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
