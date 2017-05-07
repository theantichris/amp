<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function(Blueprint $table){
            $table->increments('id');

            $table->string('name')->unique();
            $table->float('cost');

            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
}
