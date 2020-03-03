<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingo_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bingo_number');
            $table->unsignedBigInteger('bingo_issuers_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bingo_issuers_id')->references('id')->on('bingo_issuers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bingo_numbers');
    }
}
