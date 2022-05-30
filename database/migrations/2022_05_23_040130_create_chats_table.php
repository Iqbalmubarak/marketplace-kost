<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kost_owner_id')->unsigned();
            $table->integer('kost_seeker_id')->unsigned();
            $table->integer('kost_id')->unsigned();
            $table->tinyInteger('owner_status')->default(0);
            $table->tinyInteger('seeker_status')->default(0);
            $table->timestamps();

            $table->foreign('kost_owner_id')->references('id')->on('kost_owners')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kost_seeker_id')->references('id')->on('kost_seekers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('chats');
    }
}
