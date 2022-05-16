<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('gender');
            $table->string('birth_place');
            $table->string('birth_day');
            $table->string('handphone', 40);
            $table->string('emergency', 40);
            $table->tinyInteger('job');
            $table->string('avatar')->nullable();
            $table->string('job_name')->nullable();
            $table->string('job_description')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
