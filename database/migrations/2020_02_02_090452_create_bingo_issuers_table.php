<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoIssuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingo_issuers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login_id')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('bingo_type')->nullable();
            $table->boolean('self_issue_flag')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bingo_issuers');
    }
}
