<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserfundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userfund', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->float('amount');
            $table->string('userID');
            $table->string('transaction_ref');
            $table->string('card-1')->nullable();
            $table->string('card-2')->nullable();
            $table->string('status');
            $table->string('date_of_funding');
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
        Schema::dropIfExists('userfund');
    }
}
