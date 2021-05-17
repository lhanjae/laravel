<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Board extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hanjae_board', function (Blueprint $table) {
            $table->id();
            $table->string('writer');
            $table->string('title');
            $table->string('comment');
            $table->integer('board_view')->default(0);
            $table->timestamp('board_date');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('hanjae_board');
    }
}
