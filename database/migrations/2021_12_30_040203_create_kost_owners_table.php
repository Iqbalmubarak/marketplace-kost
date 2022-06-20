<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kost_owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->string('handphone', 40);
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('ktp')->nullable();
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
        Schema::dropIfExists('kost_owners');
    }
}
