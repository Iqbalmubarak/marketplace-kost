<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kost_seeker_id')->unsigned();
            $table->integer('rent_id')->unsigned();
            $table->timestamps();

            $table->foreign('kost_seeker_id')->references('id')->on('kost_seekers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('rent_id')->references('id')->on('rents')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
