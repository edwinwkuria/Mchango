<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundraisers', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->string('name');
            $table->longtext('description');
            $table->string('accountNumber');
            $table->boolean('isActive');
            $table->integer('target');
            $table->integer('amountRaised');
            $table->integer('numberOfContributors');
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
        Schema::dropIfExists('fundraisers');
    }
}
