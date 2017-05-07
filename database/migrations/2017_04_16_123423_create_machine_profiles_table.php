<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('machine_profiles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type')->unique();
            $table->float('setup_fee');
            $table->float('rate');

            $table->float('markup');

            $table->string('time_calculation_method');
            $table->float('build_rate');

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
        Schema::dropIfExists('machine_profiles');
    }
}
