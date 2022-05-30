<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('total_price');
            $table->tinyInteger('status');
            $table->date('started_at');
            $table->date('ended_at');
            $table->string('payment')->nullable();
            $table->integer('rent_id')->unsigned();
            $table->integer('price_list_id')->unsigned();
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('price_list_id')->references('id')->on('price_lists')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_details');
    }
}
