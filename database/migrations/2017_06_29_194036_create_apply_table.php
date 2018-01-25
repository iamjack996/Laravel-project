<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('apply', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->integer('user_id')->nullable()->unsigned();
          $table->integer('company_id')->nullable()->unsigned();
          $table->integer('article_id')->unsigned();
          $table->string('article_title')->nullable();
          $table->string('article_type')->nullable();
          $table->string('article_company')->nullable();
          $table->string('article_location')->nullable();
          $table->boolean('notice')->nullable()->default(0);
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('article_id')->references('id')->on('article')->onDelete('cascade');
          $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('apply');
    }
}
