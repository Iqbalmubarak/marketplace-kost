<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kost_seekers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->string('handphone', 40);
            $table->tinyInteger('gender')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('birth_day')->nullable();
            $table->string('emergency', 40)->nullable();
            $table->tinyInteger('job')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('job_name')->nullable();
            $table->string('job_description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kost_seekers');
    }
}
