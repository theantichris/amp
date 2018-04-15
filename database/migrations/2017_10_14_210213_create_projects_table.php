<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->string('name');

            $table->enum('status', [
                'New',
                'Ready To Quote',
                'Quote Generated',
                'Quote Sent',
                'Quote Accepted',
                'Quote Rejected',
                'Pre-Production',
                'Production',
                'Post-Production',
                'Quality Control',
                'Shipping',
                'Shipped',
                'Delivered',
                'Invoiced',
                'Paid',
                'Complete',
            ]);

            $table->integer('customer_id')
                  ->unsigned()
                  ->index()
                  ->nullable();

            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');

            $table->integer('manager_id')
                  ->unsigned()
                  ->index()
                  ->nullable();

            $table->foreign('manager_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->integer('team_id')
                  ->unsigned();

            $table->foreign('team_id')
                  ->references('id')
                  ->on('teams')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
}
