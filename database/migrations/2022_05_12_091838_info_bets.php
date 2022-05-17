<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_bets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid');
            $table->string('third_party_code');
            $table->string('third_party_name');
            $table->string('game_code');
            $table->string('amount');
            $table->string('round_id');
            $table->string('trans_id');
            $table->string('date');
            $table->string('game_type');
            $table->string('is_refunded');
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
        //
    }
};
