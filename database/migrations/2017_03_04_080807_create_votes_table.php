<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tiket_id')->unsigned();
            $table->integer('kandidat_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('votes', function(Blueprint $table){
          $table->foreign('tiket_id')->references('id')->on('tikets')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('kandidat_id')->references('id')->on('kandidats')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
