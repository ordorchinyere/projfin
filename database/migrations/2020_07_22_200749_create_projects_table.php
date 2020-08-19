<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->dateTime('issue_date');
            $table->string('title');
            $table->string('user_id');
            $table->text('images');
            $table->text('video');
            $table->text('plagiarism_document');
            $table->text('project_link');
            $table->text('keywords');
            $table->text('sdg');
            $table->text('document');
            $table->text('abstract');
            $table->text('feedback')->nullable();
            $table->string('supervisor_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('projects');
    }
}
