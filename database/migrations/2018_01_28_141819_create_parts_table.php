<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('quantity');
            $table->text('requirements')->nullable();
            $table->text('description')->nullable();

            $table->integer('project_id')
                  ->unsigned()
                  ->index()
                  ->nullable();

            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects');

            $table->integer('team_id')
                  ->unsigned();

            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');

            $table->integer('material_id')
                  ->unsigned()
                  ->index()
                  ->nullable();

            $table->foreign('material_id')
                  ->references('id')
                  ->on('materials');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
