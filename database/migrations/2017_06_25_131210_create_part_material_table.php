<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('part_material', function (Blueprint $table) {
            $table->integer('part_id')->unsigned()->nullable();
            $table->foreign('part_id')
                  ->references('id')
                  ->on('parts')
                  ->onDelete('cascade');

            $table->integer('material_id')->unsigned()->nullabel();
            $table->foreign('material_id')
                  ->references('id')
                  ->on('materials')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('part_material');
    }
}
