<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingo_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_array');
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
        Schema::dropIfExists('bingo_cards');
    }
}
