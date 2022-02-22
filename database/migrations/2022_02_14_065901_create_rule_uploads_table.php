<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuleUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
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
        Schema::dropIfExists('rule_uploads');
    }
}
