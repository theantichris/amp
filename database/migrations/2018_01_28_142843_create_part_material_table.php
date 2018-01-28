<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('part_material', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('material_id')
                  ->unsigned()
                  ->index();

            $table->foreign('material_id')
                  ->references('id')
                  ->on('materials')
                  ->onDelete('cascade');

            $table->integer('part_id')
                  ->unsigned()
                  ->index();

            $table->foreign('part_id')
                  ->references('id')
                  ->on('parts')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('part_material');
    }
}
