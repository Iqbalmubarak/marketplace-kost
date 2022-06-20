<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('imb')->nullable();
            $table->string('exist')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_handphone')->nullable();
            $table->string('reject_note')->nullable();
            $table->text('note')->nullable();
            $table->float('latitude', 10,9);
            $table->float('longitude', 200,9);
            $table->tinyInteger('status')->default(0);
            $table->integer('kost_type_id')->unsigned();
            $table->integer('kost_owner_id')->unsigned();
            $table->timestamps();

            $table->foreign('kost_owner_id')->references('id')->on('kost_owners')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kost_type_id')->references('id')->on('kost_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kosts');
    }
}
