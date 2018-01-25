<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('article', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->string('title');
          $table->integer('user_id')->unsigned();
          $table->string('type');
          $table->string('location');
          $table->string('address');
          $table->double('maplat',20,10);
          $table->double('maplng',20,10);
          $table->date('deadline');
          $table->string('howlong');
          $table->string('company');
          $table->string('content');
          $table->string('numofpeople');
          $table->string('skill');
          $table->string('detail');
          $table->integer('salt');
          $table->integer('numoflike')->nullable()->default(0);
          $table->integer('numofapply')->nullable()->default(0);
          $table->string('popularity')->nullable(); //
          $table->boolean('hot')->nullable();
          $table->binary('img1')->nullable();
          $table->binary('img2')->nullable();
          $table->binary('img3')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->rememberToken();
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
        Schema::dropIfExists('article');
    }
}
