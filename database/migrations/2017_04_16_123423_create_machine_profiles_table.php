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

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('machine_profiles');
    }
}
