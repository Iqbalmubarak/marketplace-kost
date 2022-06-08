<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherKostFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_kost_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('kost_id')->unsigned();
            $table->timestamps();

            $table->foreign('kost_id')->references('id')->on('kosts')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_kost_facilities');
    }
}
