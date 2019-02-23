<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';


            $table->increments('id');
            $table->string('name');
            $table->string('preview');
            $table->text('content');
            $table->integer('category_id')->unsigned();
            $table->string('image');
            $table->boolean('is_active');
            $table->integer('category_id');
            $table->integer('user_create_id');
            $table->integer('user_update_id');
            $table->string('url');
            $table->integer('user_create_id')->unsigned()->nullable();
            $table->integer('user_update_id')->unsigned()->nullable();
            $table->timestamps();


        });

        Schema::table('articles', function($table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_create_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_update_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
