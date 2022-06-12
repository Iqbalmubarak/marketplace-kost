<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('total_price');
            $table->tinyInteger('status')->default(1);
            $table->date('started_at');
            $table->date('ended_at');
            $table->string('payment');
            $table->integer('kost_seeker_id')->unsigned();
            $table->integer('room_type_id')->unsigned();
            $table->integer('price_list_id')->unsigned();
            $table->integer('payment_method_detail_id')->unsigned();
            $table->timestamps();

            $table->foreign('payment_method_detail_id')->references('id')->on('payment_method_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kost_seeker_id')->references('id')->on('kost_seekers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
