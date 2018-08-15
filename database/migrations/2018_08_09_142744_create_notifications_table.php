<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject',50);
            $table->integer('user_id')->unsigned();
            $table->integer('tutorial_id')->unsigned();
            $table->boolean('seen')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tutorial_id')->references('id')->on('tutorials')->onDelete('cascade');

        });

      //   Schema::table('notifications', function($table) {
      //   $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      //   // $table->foreign('tutorial_id')->references('id')->on('tutorials')->onDelete('cascade');
      // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
