<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->float('cost');

            $table->enum('weight_unit', [
                'kg',
                'lb',
            ]);

            $table->float('density');
            $table->enum('density_unit', [
                'g/cc',
                'lb/cf',
            ]);

            $table->integer('team_id')
                  ->unsigned();

            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
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
