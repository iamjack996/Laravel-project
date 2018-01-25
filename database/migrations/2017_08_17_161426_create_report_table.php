<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('report', function (Blueprint $table) {
          $table->increments('id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->integer('company_id')->unsigned();
          $table->integer('article_id')->unsigned();
          $table->string('article_title')->nullable();
          $table->string('article_type')->nullable();
          $table->string('article_company')->nullable();
          $table->string('report_reason')->nullable();
          $table->string('report_content')->nullable();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('article_id')->references('id')->on('article')->onDelete('cascade');
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
        Schema::dropIfExists('report');
    }
}
