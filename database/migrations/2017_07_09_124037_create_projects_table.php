<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->enum('status', [
                'New',
            ]);

            $table->enum('type', [
                'Customer',
                'Internal',
            ]);

            $table->date('due_date')->nullable();

            $table->integer('project_manager_id')->unsigned();
            $table->foreign('project_manager_id')
                  ->references('id')
                  ->on('users');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
