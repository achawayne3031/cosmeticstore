<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trans', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('userID');
            $table->float('amount');
            $table->string('desc');
            $table->string('status');
            $table->string('ref');
            $table->string('date_of_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trans');
    }
}
